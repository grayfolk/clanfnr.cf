<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%accessory}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Equipment[] $equipments
 * @property Equipment[] $equipments0
 */
class Accessory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%accessory}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
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
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments0()
    {
        return $this->hasMany(Equipment::className(), ['accessory_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AccessoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccessoryQuery(get_called_class());
    }
}
