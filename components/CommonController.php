<?php

namespace app\components;

use Yii;
use yii\web\Controller;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class CommonController extends Controller {
	public $firstColumns = 3;
	public function init() {
		$this->view->params ['firstColumns'] = $this->firstColumns;
	}
}
