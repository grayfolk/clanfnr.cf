<?php

namespace app\models\ar;

use Yii;

class Event extends \app\models\Event {
	public function getLocation() {
		return $this->hasOne ( Location::className (), [ 
				'id' => 'invider_id' 
		] );
	}
	public function beforeSave($insert) {
		if (parent::beforeSave ( $insert )) {
			if ($this->coverage != 'none') {
				$this->invider_id = null;
			}
			return true;
		}
		return false;
	}
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave ( $insert, $changedAttributes );
	}
}
