<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%equipment_experience}}".
 *
 * @property integer $equipment_id
 * @property integer $experience_id
 * @property integer $level_id
 * @property double $quantity
 *
 * @property Level $level
 * @property Equipment $equipment
 * @property Experience $experience
 */
class EquipmentExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%equipment_experience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipment_id', 'experience_id', 'level_id'], 'required'],
            [['equipment_id', 'experience_id', 'level_id'], 'integer'],
            [['quantity'], 'number'],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_id' => 'id']],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experience::className(), 'targetAttribute' => ['experience_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equipment_id' => Yii::t('app', 'Equipment ID'),
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
    public function getEquipment()
    {
        return $this->hasOne(Equipment::className(), ['id' => 'equipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperience()
    {
        return $this->hasOne(Experience::className(), ['id' => 'experience_id']);
    }

    /**
     * @inheritdoc
     * @return EquipmentExperienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EquipmentExperienceQuery(get_called_class());
    }
}
