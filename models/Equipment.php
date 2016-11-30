<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%equipment}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $accessory_id
 * @property integer $type_id
 * @property integer $level
 * @property integer $silver
 *
 * @property EqiupmentExpirience[] $eqiupmentExpiriences
 * @property EqiupmentMaterial[] $eqiupmentMaterials
 * @property Material[] $materials
 * @property AccessoryType $type
 * @property Accessory $accessory
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%equipment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accessory_id', 'type_id', 'level', 'silver'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccessoryType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['accessory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accessory::className(), 'targetAttribute' => ['accessory_id' => 'id']],
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
            'accessory_id' => Yii::t('app', 'Accessory ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'level' => Yii::t('app', 'Level'),
            'silver' => Yii::t('app', 'Silver'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqiupmentExpiriences()
    {
        return $this->hasMany(EqiupmentExpirience::className(), ['equipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqiupmentMaterials()
    {
        return $this->hasMany(EqiupmentMaterial::className(), ['equipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['id' => 'material_id'])->viaTable('{{%eqiupment_material}}', ['equipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AccessoryType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessory()
    {
        return $this->hasOne(Accessory::className(), ['id' => 'accessory_id']);
    }
}
