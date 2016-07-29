<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%eqiupment_material}}".
 *
 * @property integer $equipment_id
 * @property integer $material_id
 * @property integer $quantity
 */
class EqiupmentMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eqiupment_material}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipment_id', 'material_id'], 'required'],
            [['equipment_id', 'material_id', 'quantity'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'material_id' => Yii::t('app', 'Material ID'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

    /**
     * @inheritdoc
     * @return EqiupmentMaterialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EqiupmentMaterialQuery(get_called_class());
    }
}
