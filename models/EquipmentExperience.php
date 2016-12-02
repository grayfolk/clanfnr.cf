<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%eqiupment_expirience}}".
 *
 * @property integer $equipment_id
 * @property integer $expirience_id
 * @property integer $level_id
 * @property double $quantity
 *
 * @property Level $level
 * @property Equipment $equipment
 * @property Expirience $expirience
 */
class EqiupmentExpirience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eqiupment_expirience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipment_id', 'expirience_id', 'level_id'], 'required'],
            [['equipment_id', 'expirience_id', 'level_id'], 'integer'],
            [['quantity'], 'number'],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_id' => 'id']],
            [['expirience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expirience::className(), 'targetAttribute' => ['expirience_id' => 'id']],
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
            'level_id' => Yii::t('app', 'Level ID'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::className(), ['id' => 'equipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpirience()
    {
        return $this->hasOne(Expirience::className(), ['id' => 'expirience_id']);
    }

    /**
     * @inheritdoc
     * @return EqiupmentExpirienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EqiupmentExpirienceQuery(get_called_class());
    }
}
