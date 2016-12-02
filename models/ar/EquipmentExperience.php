<?php

namespace app\models\ar;

use Yii;

class EquipmentExperience extends \app\models\EquipmentExperience {
	public static function getEquipmentExperience($id) {
		$data = [ ];
		if ($res = self::find ()->with ( [ 
				'level',
				'equipment',
				'experience' 
		] )->where ( [ 
				'equipment_id' => $id 
		] )->all ()) {
			foreach ( $res as $row ) {
				if (! array_key_exists ( $row->experience_id, $data ))
					$data [$row->experience_id] = [ 
							'id' => $row->experience_id,
							'title' => $row->experience->title 
					];
				$data [$row->experience_id] ['levels'] [$row->level_id] = $row->quantity;
			}
		}
		return $data;
	}
}
