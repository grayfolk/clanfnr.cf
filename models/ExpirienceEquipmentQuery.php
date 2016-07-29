<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ExpirienceEquipment]].
 *
 * @see ExpirienceEquipment
 */
class ExpirienceEquipmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ExpirienceEquipment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExpirienceEquipment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
