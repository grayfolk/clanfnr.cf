<?php

namespace app\controllers;

use Yii;
use app\components\CommonController;
use app\models\ar\Equipment;
use yii\data\ActiveDataProvider;
use app\models\ar\Expirience;
use app\models\ar\AccessoryType;
use app\models\ar\Accessory;
use app\models\ar\Material;
use app\models\ar\EqiupmentExpirience;
use yii\helpers\ArrayHelper;

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
						'eqiupmentExpiriences',
						'eqiupmentMaterials' 
				] )->where ( [ 
						'level' => 100 
				] ),
				'sort' => false,
				'pagination' => false 
		] );
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider,
				'expiriences' => Expirience::find ()->all (),
				'accessoryTypes' => AccessoryType::find ()->all (),
				'accessories' => Accessory::find ()->all (),
				'materials' => Material::find ()->all () 
		] );
	}
	public function actionJson() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data = $where = [ ];
		if (Yii::$app->request->isAjax) {
			Equipment::find ()->with ( [ 
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
					'eqiupmentExpiriences',
					'eqiupmentMaterials' 
			] )->where ( [ 
					'accessory_id' => [ 
							1,
							2 
					] 
			] )->all ();
			$expiriences = Expirience::find ()->all ();
			$materials = Material::find ()->all ();
			$materialsArray = ArrayHelper::map ( $materials, 'id', 'title' );
			$expiriencesArray = ArrayHelper::map ( $expiriences, 'id', 'title' );
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
			if (count ( $where )) {
				$query = $query->andWhere ( $where );
			}
			if (array_key_exists ( 'expiriences', $form ) && count ( $form ['expiriences'] )) {
				if (array_key_exists ( 'expirienceAnd', $form )) {
					$condition = [ 
							'and' 
					];
					foreach ( $form ['expiriences'] as $id ) {
						$condition [] = 'expirience_id = ' . $id;
					}
					$query = $query->andWhere ( [ 
							'in',
							'id',
							EqiupmentExpirience::find ()->select ( 'equipment_id' )->where ( $condition )->groupBy ( [ 
									'equipment_id' 
							] ) 
					] );
				} else {
					$query = $query->andWhere ( [ 
							'in',
							'id',
							EqiupmentExpirience::find ()->select ( 'equipment_id' )->where ( [ 
									'expirience_id' => $form ['expiriences'] 
							] )->groupBy ( [ 
									'equipment_id' 
							] ) 
					] );
				}
			}
			/*
			 * var_dump ( $query->prepare ( Yii::$app->db->queryBuilder )->createCommand ()->rawSql ); exit ();
			 */
			
			$equipments = $query->limit ( Yii::$app->request->post ( 'length', 50 ) )->orderBy ( $order )->offset ( Yii::$app->request->post ( 'start', 0 ) )->all ();
			if ($equipments) {
				foreach ( $equipments as $equipment ) {
					$expirienceData = $expiriencesColumns = $materialsColumn = [ ];
					if ($expiriences) {
						foreach ( $expiriences as $expirience ) {
							foreach ( $equipment->eqiupmentExpiriences as $row ) {
								if ($row->expirience_id == $expirience->id)
									$expirienceData [$row->level_id] = $row->quantity;
							}
							$expiriencesColumns [] = \app\helpers\CommonHelper::createExpirienceTable ( $expirienceData );
						}
					}
					if ($materials) {
						foreach ( $materials as $material ) {
							foreach ( ArrayHelper::map ( $equipment->eqiupmentMaterials, 'material_id', 'quantity' ) as $key => $quantity ) {
								$materialsColumn [$key] = $materialsArray [$key] . ($quantity > 1 ? " ($quantity)" : '');
							}
						}
					}
					$data [] = array_merge ( [ 
							'<a tabindex="-1" role="button" data-toggle="popover" title="' . $equipment->title . '" data-content="' . \app\helpers\CommonHelper::createExpiriencesTable ( $equipment, $expiriencesArray ) . '">' . $equipment->title . '</a>',
							implode ( ' ', [ 
									$equipment->accessory ? '<span class="label label-info">' . $equipment->accessory->title . '</span>' : '',
									$equipment->type ? '<span class="label label-default">' . $equipment->type->title . '</span>' : '' 
							] ),
							$equipment->level 
					], $expiriencesColumns, [ 
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
