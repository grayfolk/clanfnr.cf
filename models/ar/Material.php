<?php

namespace app\models\ar;

use Yii;

class Material extends \app\models\Material {
	
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave ( $insert, $changedAttributes );
		MaterialExpirience::deleteAll ( [ 
				'material_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'expirience' ) && is_array ( Yii::$app->request->post ( 'expirience' ) )) {
			foreach ( Yii::$app->request->post ( 'expirience' ) as $expirience => $levels ) {
				foreach ( $levels as $level => $quantity ) {
					$me = new MaterialExpirience ();
					$me->material_id = $this->id;
					$me->expirience_id = $expirience;
					$me->level_id = $level;
					$me->quantity = $quantity;
					$me->save ();
				}
			}
		}
		MaterialLocation::deleteAll ( [ 
				'material_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'locations' ) && is_array ( Yii::$app->request->post ( 'locations' ) )) {
			foreach ( Yii::$app->request->post ( 'locations' ) as $location ) {
				$ml = new MaterialLocation ();
				$ml->material_id = $this->id;
				$ml->location_id = $location;
				$ml->save ();
			}
		}
	}
	public function getMaterialType() {
		return $this->hasOne ( MaterialType::className (), [ 
				'id' => 'type_id' 
		] );
	}
	
	/*
	 * public function getMaterialExpirience() { return $this->hasMany(MaterialExpirience::className(), ['material_id' => 'id']); }
	 */
	public function getExpirience() {
		return $this->hasOne ( Expirience::className (), [ 
				'id' => 'expirience_id' 
		] )->viaTable ( '{{%material_expirience}}', [ 
				'material_id' => 'id' 
		] );
	}
}
