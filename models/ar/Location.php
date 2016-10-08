<?php

namespace app\models\ar;

use Yii;

class Location extends \app\models\Location {
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave ( $insert, $changedAttributes );
		MaterialLocation::deleteAll ( [ 
				'location_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'materials' ) && is_array ( Yii::$app->request->post ( 'materials' ) )) {
			foreach ( Yii::$app->request->post ( 'materials' ) as $material ) {
				$ml = new MaterialLocation ();
				$ml->material_id = $material;
				$ml->location_id = $this->id;
				$ml->save ();
			}
		}
	}
}
