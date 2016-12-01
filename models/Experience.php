<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%expirience}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property ExpirienceEquipment[] $expirienceEquipments
 * @property Equipment[] $equipment
 */
class Expirience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expirience}}';
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
    public function getExpirienceEquipments()
    {
        return $this->hasMany(ExpirienceEquipment::className(), ['expirience_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasMany(Equipment::className(), ['id' => 'equipment_id'])->viaTable('{{%expirience_equipment}}', ['expirience_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ExpirienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpirienceQuery(get_called_class());
    }
}
