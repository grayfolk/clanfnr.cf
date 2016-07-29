<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;

class AdminController extends Controller {
	public $layout = '@app/views/layouts/admin';
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'ruleConfig' => [ 
								'class' => AccessRule::className () 
						],
						'rules' => [ 
								[ 
										'allow' => true,
										'roles' => [ 
												'admin' 
										] 
								] 
						] 
				],
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ ] 
				] 
		];
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
}
