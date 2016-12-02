<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MaterialExperience]].
 *
 * @see MaterialExperience
 */
class MaterialExperienceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MaterialExperience[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MaterialExperience|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
