<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Event;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\components\CommonBackendController;
use yii\filters\VerbFilter;

/**
 * EventsController implements the CRUD actions for Event model.
 */
class EventController extends CommonBackendController {
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
	 * Lists all Event models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => Event::find ()->with ( 'type' )->orderBy ( [ 
						'start' => SORT_DESC 
				] ) 
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Event model.
	 *
	 * @param integer $type_id        	
	 * @param string $start        	
	 * @return mixed
	 */
	public function actionView($type_id, $start, $invider_id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $type_id, $start, $invider_id ) 
		] );
	}
	
	/**
	 * Creates a new Event model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Event ();
		
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
	 * Updates an existing Event model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $type_id        	
	 * @param string $start        	
	 * @return mixed
	 */
	public function actionUpdate($type_id, $start, $invider_id) {
		$model = $this->findModel ( $type_id, $start, $invider_id );
		
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
	 * Deletes an existing Event model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $type_id        	
	 * @param string $start        	
	 * @return mixed
	 */
	public function actionDelete($type_id, $start, $invider_id) {
		$this->findModel ( $type_id, $start, $invider_id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Event model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $type_id        	
	 * @param string $start        	
	 * @return Event the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($type_id, $start, $invider_id) {
		if (($model = Event::findOne ( [ 
				'type_id' => $type_id,
				'start' => $start,
				'invider_id' => $invider_id 
		] )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
