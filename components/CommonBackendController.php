<?php

namespace app\components;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;

/**
 *
 * @author Vladymyr Protsenko <grayfolk@gmail.com>
 */
class CommonBackendController extends CommonController {
	public $layout = '@app/views/layouts/admin';
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'ruleConfig' => [ 
								'class' => AccessRule::className () 
						],
						'rules' => [ 
								[ 
										'allow' => true,
										'roles' => [ 
												'admin' 
										] 
								] 
						] 
				],
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ ] 
				] 
		];
	}
	public function init() {
		/*
		 * $this->view->params ['levels'] = Level::find ()->orderBy ( [ 'id' => SORT_ASC ] )->all ();
		 */
	}
}
