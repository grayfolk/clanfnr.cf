<?php

namespace app\controllers;

use Yii;
use app\components\CommonController;
use app\models\ar\Equipment;
use yii\data\ActiveDataProvider;
use app\models\ar\Experience;
use app\models\ar\AccessoryType;
use app\models\ar\Accessory;
use app\models\ar\Material;
use app\models\ar\EquipmentExperience;
use yii\helpers\ArrayHelper;
use app\models\ar\EquipmentMaterial;

class EquipmentController extends CommonController {
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => Equipment::find ()->with ( [ 
						'accessory' => function ($query) {
							$query->from ( [ 
									'accessory' 
							] );
						},
						'type' => function ($query) {
							$query->from ( [ 
									'accessory_type' 
							] );
						},
						'equipmentExperiences',
						'equipmentMaterials' 
				] )->where ( [ 
						'level' => 100 
				] ),
				'sort' => false,
				'pagination' => false 
		] );
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider,
				'experiences' => Experience::find ()->orderBy ( [ 
						'title' => SORT_ASC 
				] )->all (),
				'accessoryTypes' => AccessoryType::find ()->all (),
				'accessories' => Accessory::find ()->all (),
				'materials' => Material::find ()->where ( [ 
						'type_id' => [ 
								1,
								3 
						] 
				] )->orderBy ( [ 
						'title' => SORT_ASC 
				] )->all () 
		] );
	}
	public function actionJson() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data = $where = [ ];
		if (Yii::$app->request->isAjax) {
			Equipment::find ()->joinWith ( [ 
					'accessory' => function ($query) {
						$query->from ( [ 
								'accessory' 
						] );
					},
					'type' => function ($query) {
						$query->from ( [ 
								'accessory_type' 
						] );
					},
					'equipmentExperiences',
					'equipmentMaterials' 
			] )->all ();
			$experiences = Experience::find ()->orderBy ( [ 
					'title' => SORT_ASC 
			] )->all ();
			$materials = Material::find ()->all ();
			$materialsArray = ArrayHelper::map ( $materials, 'id', 'title' );
			$experiencesArray = ArrayHelper::map ( $experiences, 'id', 'title' );
			$experiencesIds = ArrayHelper::getColumn ( $experiences, 'id' );
			$query = Equipment::find ()->where ( '1=1' );
			// Default order
			$order = [ 
					'equipment.level' => SORT_DESC,
					'equipment.title' => SORT_ASC 
			];
			// Process input data
			parse_str ( Yii::$app->request->post ( 'form' ), $form );
			if (array_key_exists ( 'accessoryTypes', $form ) && count ( $form ['accessoryTypes'] )) {
				$where ['type_id'] = $form ['accessoryTypes'];
			}
			if (array_key_exists ( 'accessories', $form ) && count ( $form ['accessories'] )) {
				$where ['accessory_id'] = $form ['accessories'];
			}
			if (array_key_exists ( 'experiences', $form ) && count ( $form ['experiences'] )) {
				if (array_key_exists ( 'experienceAnd', $form )) {
					$query = $query->andWhere ( [ 
							'in',
							'id',
							EquipmentExperience::find ()->select ( 'equipment_id' )->where ( [ 
									'experience_id' => $form ['experiences'] 
							] )->groupBy ( [ 
									'equipment_id' 
							] )->having ( [ 
									'count(*)' => count ( $form ['experiences'] ) * 6 
							] ) 
					] );
				} else {
					$query = $query->andWhere ( [ 
							'in',
							'id',
							EquipmentExperience::find ()->select ( 'equipment_id' )->where ( [ 
									'experience_id' => $form ['experiences'] 
							] )->groupBy ( [ 
									'equipment_id' 
							] ) 
					] );
				}
			}
			if (array_key_exists ( 'materials', $form ) && count ( $form ['materials'] )) {
				$query = $query->andWhere ( [ 
						'in',
						'id',
						EquipmentMaterial::find ()->select ( 'equipment_id' )->where ( [ 
								'material_id' => $form ['materials'] 
						] )->groupBy ( [ 
								'equipment_id' 
						] )->having ( [ 
								'count(*)' => count ( $form ['materials'] ) 
						] ) 
				] );
			}
			if (Yii::$app->request->post ( 'order' ) && count ( Yii::$app->request->post ( 'order' ) )) {
				// Reset default order
				$order = [ ];
				foreach ( Yii::$app->request->post ( 'order' ) as $o ) {
					if (isset ( $o ['column'] )) {
						switch ($o ['column']) {
							case 0 : // title
								$order ['equipment.title'] = isset ( $o ['dir'] ) && $o ['dir'] == 'desc' ? SORT_DESC : SORT_ASC;
								break;
							case 2 : // level
								$order ['equipment.level'] = isset ( $o ['dir'] ) && $o ['dir'] == 'desc' ? SORT_DESC : SORT_ASC;
								break;
							case count ( $experiences ) + static::$firstColumns : // silver
								$order ['equipment.silver'] = isset ( $o ['dir'] ) && $o ['dir'] == 'desc' ? SORT_DESC : SORT_ASC;
								break;
							default :
								if (in_array ( $o ['column'], range ( static::$firstColumns, count ( $experiences ) + static::$firstColumns ) )) {
									// Experiences
									// Search experience id
									$expId = $experiencesIds [$o ['column'] - static::$firstColumns];
									$query = $query->innerJoin ( '{{%equipment_experience}} e' . $expId, '{{%e' . $expId . '}}.[[equipment_id]] = {{%equipment}}.[[id]] and {{%e' . $expId . '}}.[[experience_id]] = ' . $expId . ' and {{%e' . $expId . '}}.[[level_id]] = 6' );
									
									$order ['{{e' . $expId . '}}.[[quantity]]'] = isset ( $o ['dir'] ) && $o ['dir'] == 'desc' ? SORT_DESC : SORT_ASC;
								}
								break;
						}
					}
				}
			}
			if (count ( $where )) {
				$query = $query->andWhere ( $where );
			}
			// Orders
			$query = $query->limit ( Yii::$app->request->post ( 'length', 50 ) )->orderBy ( $order )->offset ( Yii::$app->request->post ( 'start', 0 ) );
			
			/*
			 * var_dump ( $query->prepare ( Yii::$app->db->queryBuilder )->createCommand ()->rawSql ); exit ();
			 */
			
			$equipments = $query->all ();
			if ($equipments) {
				foreach ( $equipments as $equipment ) {
					$experienceData = $experiencesColumns = $materialsColumn = [ ];
					if ($experiences) {
						foreach ( $experiences as $experience ) {
							foreach ( $equipment->equipmentExperiences as $row ) {
								if ($row->experience_id == $experience->id)
									$experienceData [$row->level_id] = $row->quantity;
							}
							$experiencesColumns [] = \app\helpers\CommonHelper::createExperienceTable ( $experienceData );
							$experienceData = [ ];
						}
					}
					if ($materials) {
						foreach ( $materials as $material ) {
							foreach ( ArrayHelper::map ( $equipment->equipmentMaterials, 'material_id', 'quantity' ) as $key => $quantity ) {
								$materialsColumn [$key] = $materialsArray [$key] . ($quantity > 1 ? " ($quantity)" : '');
							}
						}
					}
					$data [] = array_merge ( [ 
							'<a tabindex="-1" role="button" data-toggle="popover" title="' . $equipment->title . '" data-content="' . \app\helpers\CommonHelper::createExperiencesTable ( $equipment, $experiencesArray ) . '">' . $equipment->title . '</a>',
							implode ( ' ', [ 
									$equipment->accessory ? '<span class="label label-info">' . $equipment->accessory->title . '</span>' : '',
									$equipment->type ? '<span class="label label-default">' . $equipment->type->title . '</span>' : '' 
							] ),
							$equipment->level 
					], $experiencesColumns, [ 
							\app\helpers\CommonHelper::thousandsCurrencyFormat ( $equipment->silver ),
							'<span style="white-space:nowrap">' . implode ( ', ', $materialsColumn ) . '</span>' 
					] );
				}
			}
			return [ 
					'draw' => Yii::$app->request->post ( 'draw', 1 ),
					'recordsTotal' => Equipment::find ()->count (),
					'recordsFiltered' => $query->count (),
					'data' => $data 
			];
		}
		return [ ];
	}
}
