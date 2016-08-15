<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Equipment;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ar\Expirience;
use app\models\ar\Level;
use app\models\ar\EqiupmentExpirience;
use app\models\ar\EqiupmentMaterial;
use app\models\ar\Material;
use app\models\ar\AccessoryType;
use app\models\ar\Accessory;
use app\components\CommonBackendController;

/**
 * EquipmentController implements the CRUD actions for Equipment model.
 */
class EquipmentController extends CommonBackendController {
	
	/**
	 * Lists all Equipment models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$query = Equipment::find ();
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query,
				'sort' => [ 
						'defaultOrder' => [ 
								'id' => SORT_DESC 
						],
						'attributes' => [ 
								'id',
								'title',
								'level',
								'silver',
								/* 'accessory.title' => [ 
										'asc' => [ 
												'accessory.title' => SORT_ASC 
										],
										'desc' => [ 
												'accessory.title' => SORT_DESC 
										],
										'default' => SORT_DESC 
								]  */
						] 
				] 
		] );
		
		$query->with ( [ 
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
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider,
				'expiriences' => Expirience::find ()->all (),
				'accessoryTypes' => AccessoryType::find ()->all (),
				'accessories' => Accessory::find ()->all (),
				'materials' => Material::find ()->all () 
		] );
	}
	
	/**
	 * Displays a single Equipment model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	
	/**
	 * Creates a new Equipment model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Equipment ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$this->updateExpiriences ( $model->id );
			$this->updateMaterials ( $model->id );
			
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model,
					'expiriences' => Expirience::find ()->all (),
					'levels' => Level::find ()->all (),
					'materials' => Material::find ()->all () 
			] );
		}
	}
	
	/**
	 * Updates an existing Equipment model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			$this->updateExpiriences ( $id );
			$this->updateMaterials ( $id );
			
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model,
					'expiriences' => Expirience::find ()->all (),
					'levels' => Level::find ()->all (),
					'materials' => Material::find ()->all (),
					'expirienceData' => EqiupmentExpirience::getEqiupmentExpirience ( $id ) 
			] );
		}
	}
	
	/**
	 * Deletes an existing Equipment model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Equipment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Equipment the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Equipment::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	protected function updateExpiriences($id) {
		EqiupmentExpirience::deleteAll ( [ 
				'equipment_id' => $id 
		] );
		if (Yii::$app->request->post ( 'expirience' ) && is_array ( Yii::$app->request->post ( 'expirience' ) )) {
			foreach ( Yii::$app->request->post ( 'expirience' ) as $expirience => $levels ) {
				foreach ( $levels as $level => $quantity ) {
					$ee = new EqiupmentExpirience ();
					$ee->equipment_id = $id;
					$ee->expirience_id = $expirience;
					$ee->level_id = $level;
					$ee->quantity = $quantity;
					$ee->save ();
				}
			}
		}
	}
	protected function updateMaterials($id) {
		EqiupmentMaterial::deleteAll ( [ 
				'equipment_id' => $id 
		] );
		if (Yii::$app->request->post ( 'material' ) && is_array ( Yii::$app->request->post ( 'material' ) )) {
			foreach ( Yii::$app->request->post ( 'material' ) as $key => $material ) {
				if ($material > 0) {
					$m = new EqiupmentMaterial ();
					$m->equipment_id = $id;
					$m->material_id = $key;
					$m->quantity = $material;
					$m->save ();
				}
			}
		}
	}
}
