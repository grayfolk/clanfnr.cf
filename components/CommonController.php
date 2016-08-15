<?php

namespace app\components;

use Yii;
use yii\web\Controller;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class CommonController extends Controller {
	public function init() {
		if (! Yii::$app->user->isGuest) {
			// $this->view->params ['opencart_category'] = new \DB\SQL\Mapper ( $db, 'opencart_categories' );
		}
	}
}
