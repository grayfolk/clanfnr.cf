<?php

namespace app\components;

use Yii;
use yii\web\Controller;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class CommonController extends Controller {
	public static $firstColumns = 3;
	public static function addViewParams() {
		Yii::$app->view->params ['firstColumns'] = static::$firstColumns;
	}
}
