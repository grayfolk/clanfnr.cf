<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%experience}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property EquipmentExperience[] $equipmentExperiences
 * @property MaterialExperience[] $materialExperiences
 */
class Experience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%experience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipmentExperiences()
    {
        return $this->hasMany(EquipmentExperience::className(), ['experience_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialExperiences()
    {
        return $this->hasMany(MaterialExperience::className(), ['experience_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ExperienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExperienceQuery(get_called_class());
    }
}
