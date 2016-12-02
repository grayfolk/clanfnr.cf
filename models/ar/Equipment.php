<?php

namespace app\models\ar;

use Yii;

class Equipment extends \app\models\Equipment {
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave ( $insert, $changedAttributes );
		EquipmentExperience::deleteAll ( [ 
				'equipment_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'experience' ) && is_array ( Yii::$app->request->post ( 'experience' ) )) {
			foreach ( Yii::$app->request->post ( 'experience' ) as $experience => $levels ) {
				foreach ( $levels as $level => $quantity ) {
					$ee = new EquipmentExperience ();
					$ee->equipment_id = $this->id;
					$ee->experience_id = $experience;
					$ee->level_id = $level;
					$ee->quantity = $quantity;
					$ee->save ();
				}
			}
		}
		EquipmentMaterial::deleteAll ( [ 
				'equipment_id' => $this->id 
		] );
		if (Yii::$app->request->post ( 'material' ) && is_array ( Yii::$app->request->post ( 'material' ) )) {
			foreach ( Yii::$app->request->post ( 'material' ) as $key => $material ) {
				if ($material > 0) {
					$m = new EquipmentMaterial ();
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
	public function getEquipmentExperiencesSort() {
		return $this->hasMany ( EquipmentExperience::className (), [ 
				'equipment_id' => 'id' 
		] )->where ( [ 
				'level_id' => 6 
		] );
	}
}
