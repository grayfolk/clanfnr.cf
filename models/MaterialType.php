<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%material_type}}".
 *
 * @property integer $id
 * @property string $title
 */
class MaterialType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%material_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
     * @inheritdoc
     * @return MaterialTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialTypeQuery(get_called_class());
    }
}
