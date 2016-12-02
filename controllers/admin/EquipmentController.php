<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Equipment;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\ar\Experience;
use app\models\ar\Level;
use app\models\ar\EquipmentExperience;
use app\models\ar\Material;
use app\models\ar\AccessoryType;
use app\models\ar\Accessory;
use app\components\CommonBackendController;
use yii\filters\VerbFilter;

/**
 * EquipmentController implements the CRUD actions for Equipment model.
 */
class EquipmentController extends CommonBackendController {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return array_merge ( parent::behaviors (), [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'POST' 
								] 
						] 
				] 
		] );
	}
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
								'title' => SORT_ASC 
						],
						'attributes' => [ 
								'id',
								'title',
								'level',
								'silver' 
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
				'equipmentExperiences',
				'equipmentMaterials' 
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider,
				'experiences' => Experience::find ()->all (),
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
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model,
					'experiences' => Experience::find ()->all (),
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
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model,
					'experiences' => Experience::find ()->all (),
					'levels' => Level::find ()->all (),
					'materials' => Material::find ()->all (),
					'experienceData' => EquipmentExperience::getEquipmentExperience ( $id ) 
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
}
