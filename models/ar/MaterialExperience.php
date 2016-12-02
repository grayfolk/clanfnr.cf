<?php

namespace app\models\ar;

use Yii;

class MaterialExpirience extends \app\models\MaterialExpirience {
	public static function getMaterialExpirience($id) {
		$data = [ ];
		if ($res = static::find ()->with ( [ 
				'level',
				'material',
				'expirience' 
		] )->where ( [ 
				'material_id' => $id 
		] )->all ()) {
			foreach ( $res as $row ) {
				if (! array_key_exists ( $row->expirience_id, $data ))
					$data [$row->expirience_id] = [ 
							'id' => $row->expirience_id,
							'title' => $row->expirience->title 
					];
				$data [$row->expirience_id] ['levels'] [$row->level_id] = $row->quantity;
			}
		}
		return $data;
	}
}
