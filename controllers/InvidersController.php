<?php

namespace app\controllers;

use Yii;
use app\components\CommonController;

class InvidersController extends CommonController {
	public function behaviors() {
		return [ ];
	}
	public function actionIndex() {
		return $this->render ( 'index' );
	}
}
