<?php

namespace app\models\ar;

use Yii;

class MaterialExperience extends \app\models\MaterialExperience {
	public static function getMaterialExperience($id) {
		$data = [ ];
		if ($res = static::find ()->with ( [ 
				'level',
				'material',
				'experience' 
		] )->where ( [ 
				'material_id' => $id 
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
