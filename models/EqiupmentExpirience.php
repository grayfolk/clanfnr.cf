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
     * @inheritdoc
     * @return EqiupmentExpirienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EqiupmentExpirienceQuery(get_called_class());
    }
}
