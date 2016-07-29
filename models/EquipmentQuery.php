<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Equipment]].
 *
 * @see Equipment
 */
class EquipmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Equipment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Equipment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
