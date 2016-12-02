<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Material;
use app\models\ar\MaterialSearch;
use yii\web\NotFoundHttpException;
use app\components\CommonBackendController;
use app\models\ar\Experience;
use app\models\ar\MaterialExperience;
use app\models\ar\Level;
use yii\filters\VerbFilter;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends CommonBackendController {
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
	 * Lists all Material models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {		
		$searchModel = new MaterialSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'experiences' => Experience::find ()->all () 
		] );
	}
	
	/**
	 * Displays a single Material model.
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
	 * Creates a new Material model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Material ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model,
					'experiences' => Experience::find ()->orderBy ( [ 
							'title' => SORT_ASC 
					] )->all (),
					'levels' => Level::find ()->all () 
			] );
		}
	}
	
	/**
	 * Updates an existing Material model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	/*
	 * public function actionUpdate($id) { $model = $this->findModel ( $id ); if ($model->load ( Yii::$app->request->post () ) && $model->save ()) { return $this->redirect ( [ 'view', 'id' => $model->id ] ); } else { return $this->render ( 'update', [ 'model' => $model ] ); } }
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
					'experiences' => Experience::find ()->orderBy ( [ 
							'title' => SORT_ASC 
					] )->all (),
					'levels' => Level::find ()->all (),
					'experienceData' => MaterialExperience::getMaterialExperience ( $id ) 
			] );
		}
	}
	
	/**
	 * Deletes an existing Material model.
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
	 * Finds the Material model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Material the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Material::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
