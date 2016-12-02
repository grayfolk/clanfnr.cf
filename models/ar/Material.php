<?php

namespace app\models\ar;

use Yii;

class Material extends \app\models\Material {
	
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave ( $insert, $changedAttributes );
		MaterialExperience::deleteAll ( [ 
				'material_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'experience' ) && is_array ( Yii::$app->request->post ( 'experience' ) )) {
			foreach ( Yii::$app->request->post ( 'experience' ) as $experience => $levels ) {
				foreach ( $levels as $level => $quantity ) {
					$me = new MaterialExperience ();
					$me->material_id = $this->id;
					$me->experience_id = $experience;
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
	 * public function getMaterialExperience() { return $this->hasMany(MaterialExperience::className(), ['material_id' => 'id']); }
	 */
	public function getExperience() {
		return $this->hasOne ( Experience::className (), [ 
				'id' => 'experience_id' 
		] )->viaTable ( '{{%material_experience}}', [ 
				'material_id' => 'id' 
		] );
	}
}
