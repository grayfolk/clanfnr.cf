<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%material}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $is_stone
 * @property integer $is_invider
 * @property integer $type_id
 *
 * @property EqiupmentMaterial[] $eqiupmentMaterials
 * @property Equipment[] $equipment
 * @property MaterialExpirience[] $materialExpiriences
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%material}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_stone', 'is_invider', 'type_id'], 'integer'],
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
            'is_stone' => Yii::t('app', 'Is Stone'),
            'is_invider' => Yii::t('app', 'Is Invider'),
            'type_id' => Yii::t('app', 'Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqiupmentMaterials()
    {
        return $this->hasMany(EqiupmentMaterial::className(), ['material_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasMany(Equipment::className(), ['id' => 'equipment_id'])->viaTable('{{%eqiupment_material}}', ['material_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialExpiriences()
    {
        return $this->hasMany(MaterialExpirience::className(), ['material_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MaterialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialQuery(get_called_class());
    }
}
