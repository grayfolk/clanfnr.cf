<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class InvidersController extends Controller {
	public function behaviors() {
		return [ ];
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
}
