<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%location_type}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Location[] $locations
 */
class LocationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LocationTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocationTypeQuery(get_called_class());
    }
}
