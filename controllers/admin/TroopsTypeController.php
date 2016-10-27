<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\TroopsType;
use yii\data\ActiveDataProvider;
use app\components\CommonBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TroopsTypeController implements the CRUD actions for TroopsType model.
 */
class TroopsTypeController extends CommonBackendController {
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
	 * Lists all TroopsType models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => TroopsType::find () 
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single TroopsType model.
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
	 * Creates a new TroopsType model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new TroopsType ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Updates an existing TroopsType model.
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
	 * Deletes an existing TroopsType model.
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
	 * Finds the TroopsType model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return TroopsType the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = TroopsType::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
