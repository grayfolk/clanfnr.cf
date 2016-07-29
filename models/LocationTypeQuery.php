<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LocationType]].
 *
 * @see LocationType
 */
class LocationTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LocationType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LocationType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
