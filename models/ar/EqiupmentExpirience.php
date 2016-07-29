<?php

namespace app\models\ar;

use Yii;

class EqiupmentExpirience extends \app\models\EqiupmentExpirience {
	public static function getEqiupmentExpirience($id) {
		$data = [ ];
		if ($res = static::find ()->with ( [ 
				'level',
				'equipment',
				'expirience' 
		] )->where ( [ 
				'equipment_id' => $id 
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
