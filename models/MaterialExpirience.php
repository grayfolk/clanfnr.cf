<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%material_expirience}}".
 *
 * @property integer $material_id
 * @property integer $expirience_id
 * @property integer $level_id
 * @property double $quantity
 *
 * @property Level $level
 * @property Expirience $expirience
 * @property Material $material
 */
class MaterialExpirience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%material_expirience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material_id', 'expirience_id', 'level_id'], 'required'],
            [['material_id', 'expirience_id', 'level_id'], 'integer'],
            [['quantity'], 'number'],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['expirience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expirience::className(), 'targetAttribute' => ['expirience_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_id' => Yii::t('app', 'Material ID'),
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
    public function getExpirience()
    {
        return $this->hasOne(Expirience::className(), ['id' => 'expirience_id']);
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
     * @return MaterialExpirienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialExpirienceQuery(get_called_class());
    }
}
