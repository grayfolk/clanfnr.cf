<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%location}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property string $color
 *
 * @property LocationType $type
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 12],
            [['title'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => Yii::t('app', 'Type ID'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(LocationType::className(), ['id' => 'type_id']);
    }

    /**
     * @inheritdoc
     * @return LocationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocationQuery(get_called_class());
    }
}
