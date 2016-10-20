<?php

namespace app\controllers;

use Yii;
use app\components\CommonController;

class MapController extends CommonController {
	public function behaviors() {
		return [ ];
	}
	public function actionIndex() {
		throw new \yii\web\GoneHttpException ( 410 );
		return $this->render ( 'index' );
	}
}
