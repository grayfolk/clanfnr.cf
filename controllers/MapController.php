<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\base\Exception;

class MapController extends Controller {
	public function behaviors() {
		return [ ];
	}
	public function actionIndex() {
		throw new \yii\web\GoneHttpException ( 410 );
		return $this->render ( 'index' );
	}
}
