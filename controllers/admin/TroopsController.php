<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Troops;
use yii\data\ActiveDataProvider;
use app\components\CommonBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TroopsController implements the CRUD actions for Troops model.
 */
class TroopsController extends CommonBackendController {
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
	 * Lists all Troops models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => Troops::find () 
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Troops model.
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
	 * Creates a new Troops model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Troops ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'index',
					'id' => $model->id 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Updates an existing Troops model.
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
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Deletes an existing Troops model.
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
	 * Finds the Troops model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Troops the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Troops::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
