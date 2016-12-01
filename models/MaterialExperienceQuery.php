<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MaterialExpirience]].
 *
 * @see MaterialExpirience
 */
class MaterialExpirienceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MaterialExpirience[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MaterialExpirience|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
