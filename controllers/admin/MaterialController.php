<?php

namespace app\controllers\admin;

use Yii;
use app\models\ar\Material;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\AdminController;
use app\components\CommonBackendController;
use app\models\ar\Expirience;
use app\models\ar\MaterialExpirience;
use app\models\ar\Level;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends CommonBackendController {
	
	/**
	 * Lists all Material models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => Material::find () /*->with ( [ 
						'materialType'
				] ),*/		 			 
		] );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider,
				// 'expirience' => Expirience::find ()->all (),
				'expiriences' => Expirience::find ()->all () 
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
			$this->updateExpiriences ( $model->id );
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model,
					'expiriences' => Expirience::find ()->all (),
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
			$this->updateExpiriences ( $id );
			
			return $this->redirect ( [ 
					'index' 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model,
					'expiriences' => Expirience::find ()->all (),
					'levels' => Level::find ()->all (),
					'expirienceData' => MaterialExpirience::getMaterialExpirience ( $id ) 
			] );
		}
	}
	protected function updateExpiriences($id) {
		MaterialExpirience::deleteAll ( [ 
				'material_id' => $id 
		] );
		if (Yii::$app->request->post ( 'expirience' ) && is_array ( Yii::$app->request->post ( 'expirience' ) )) {
			foreach ( Yii::$app->request->post ( 'expirience' ) as $expirience => $levels ) {
				foreach ( $levels as $level => $quantity ) {
					$ee = new MaterialExpirience ();
					$ee->material_id = $id;
					$ee->expirience_id = $expirience;
					$ee->level_id = $level;
					$ee->quantity = $quantity;
					$ee->save ();
				}
			}
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
