<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Expirience;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\AdminController;
use app\components\CommonBackendController;

/**
 * ExpirienceController implements the CRUD actions for Expirience model.
 */
class ExpirienceController extends CommonBackendController {
	
	/**
	 * Lists all Expirience models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => Expirience::find () 
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Expirience model.
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
	 * Creates a new Expirience model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Expirience ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( 'index' );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Updates an existing Expirience model.
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
	 * Deletes an existing Expirience model.
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
	 * Finds the Expirience model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Expirience the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Expirience::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
