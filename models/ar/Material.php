<?php

namespace app\models\ar;

use Yii;

class Material extends \app\models\Material {
	
	public function getMaterialType()
    {
        return $this->hasOne(MaterialType::className(), ['id' => 'type_id']);
    }
    
/*   public function getMaterialExpirience()
    {
        return $this->hasMany(MaterialExpirience::className(), ['material_id' => 'id']);
    }*/
    
    public function getExpirience()
    {
        return $this->hasOne(Expirience::className(), ['id' => 'expirience_id'])->viaTable('{{%material_expirience}}', ['material_id' => 'id']);
    }
    
}
