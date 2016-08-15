<?php

namespace app\components;

use Yii;
use app\models\ar\Level;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class CommonBackendController extends CommonController {
	public $layout = '@app/views/layouts/admin';
	public function init() {
		/* $this->view->params ['levels'] = Level::find ()->orderBy ( [ 
				'id' => SORT_ASC 
		] )->all (); */
	}
}
