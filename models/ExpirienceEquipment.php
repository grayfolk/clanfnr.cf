<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%expirience_equipment}}".
 *
 * @property integer $equipment_id
 * @property integer $expirience_id
 *
 * @property Expirience $expirience
 * @property Equipment $equipment
 */
class ExpirienceEquipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expirience_equipment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipment_id', 'expirience_id'], 'required'],
            [['equipment_id', 'expirience_id'], 'integer'],
            [['expirience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expirience::className(), 'targetAttribute' => ['expirience_id' => 'id']],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'expirience_id' => Yii::t('app', 'Expirience ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpirience()
    {
        return $this->hasOne(Expirience::className(), ['id' => 'expirience_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::className(), ['id' => 'equipment_id']);
    }

    /**
     * @inheritdoc
     * @return ExpirienceEquipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpirienceEquipmentQuery(get_called_class());
    }
}
