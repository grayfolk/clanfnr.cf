<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\components\CommonController;
use yii\filters\VerbFilter;

class InvidersController extends CommonController {
	public function behaviors() {
		return [ ];
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
}
