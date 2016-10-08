<?php

namespace app\controllers;

use Yii;
use app\components\CommonBackendController;

class AdminController extends CommonBackendController {
	public function actionIndex() {
		return $this->render ( 'index' );
	}
}
