<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%equipment_material}}".
 *
 * @property integer $equipment_id
 * @property integer $material_id
 * @property integer $quantity
 *
 * @property Equipment $equipment
 * @property Material $material
 */
class EquipmentMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%equipment_material}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipment_id', 'material_id'], 'required'],
            [['equipment_id', 'material_id', 'quantity'], 'integer'],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::className(), ['id' => 'equipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    /**
     * @inheritdoc
     * @return EquipmentMaterialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EquipmentMaterialQuery(get_called_class());
    }
}
