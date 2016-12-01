<?php

namespace app\models\ar;

use Yii;

class Equipment extends \app\models\Equipment {
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave ( $insert, $changedAttributes );
		EqiupmentExpirience::deleteAll ( [ 
				'equipment_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'expirience' ) && is_array ( Yii::$app->request->post ( 'expirience' ) )) {
			foreach ( Yii::$app->request->post ( 'expirience' ) as $expirience => $levels ) {
				foreach ( $levels as $level => $quantity ) {
					$ee = new EqiupmentExpirience ();
					$ee->equipment_id = $this->id;
					$ee->expirience_id = $expirience;
					$ee->level_id = $level;
					$ee->quantity = $quantity;
					$ee->save ();
				}
			}
		}
		EqiupmentMaterial::deleteAll ( [ 
				'equipment_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'material' ) && is_array ( Yii::$app->request->post ( 'material' ) )) {
			foreach ( Yii::$app->request->post ( 'material' ) as $key => $material ) {
				if ($material > 0) {
					$m = new EqiupmentMaterial ();
					$m->equipment_id = $this->id;
					$m->material_id = $key;
					$m->quantity = $material;
					$m->save ();
				}
			}
		}
	}
	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEqiupmentExpiriencesSort() {
		return $this->hasMany ( EqiupmentExpirience::className (), [ 
				'equipment_id' => 'id' 
		] )->where ( [ 
				'level_id' => 6 
		] );
	}
}
