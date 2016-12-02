<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EquipmentExperience]].
 *
 * @see EquipmentExperience
 */
class EquipmentExperienceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EquipmentExperience[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EquipmentExperience|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
