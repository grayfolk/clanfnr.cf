<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MaterialType]].
 *
 * @see MaterialType
 */
class MaterialTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MaterialType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MaterialType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
