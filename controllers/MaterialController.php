<?php

namespace app\controllers;

use Yii;
use app\components\CommonController;
use app\models\ar\Material;
use app\models\ar\MaterialLocation;
use app\models\ar\Location;
use app\models\ar\Experience;

class MaterialController extends CommonController {
	public function actionIndex() {
		return $this->render ( 'index', [ 
				'materials' => Material::find ()->with ( [ 
						'materialExperiences' 
				] )->orderBy ( [ 
						'title' => SORT_ASC 
				] )->all (),
				'locations' => Location::find ()->orderBy ( [ 
						'title' => SORT_ASC 
				] )->all (),
				'materialLocations' => MaterialLocation::find ()->all (),
				'experiences' => Experience::find ()->all () 
		] );
	}
}
