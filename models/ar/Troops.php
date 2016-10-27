<?php

namespace app\models\ar;

use Yii;


class Troops extends \app\models\Troops
{
    
	public function getTroopsType()
    {
        return $this->hasOne(TroopsType::className(), ['id' => 'type_id']);
    }
    
    
	public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }
}

