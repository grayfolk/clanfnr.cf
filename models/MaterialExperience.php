<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%material_experience}}".
 *
 * @property integer $material_id
 * @property integer $experience_id
 * @property integer $level_id
 * @property double $quantity
 *
 * @property Level $level
 * @property Experience $experience
 * @property Material $material
 */
class MaterialExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%material_experience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material_id', 'experience_id', 'level_id'], 'required'],
            [['material_id', 'experience_id', 'level_id'], 'integer'],
            [['quantity'], 'number'],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experience::className(), 'targetAttribute' => ['experience_id' => 'id']],
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
            'experience_id' => Yii::t('app', 'Experience ID'),
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
    public function getExperience()
    {
        return $this->hasOne(Experience::className(), ['id' => 'experience_id']);
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
     * @return MaterialExperienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialExperienceQuery(get_called_class());
    }
}
