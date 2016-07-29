<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%accessory_type}}".
 *
 * @property integer $id
 * @property string $title
 */
class AccessoryType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%accessory_type}}';
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
     * @inheritdoc
     * @return AccessoryTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccessoryTypeQuery(get_called_class());
    }
}
