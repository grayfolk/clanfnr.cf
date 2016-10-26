<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "troops".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $level_id
 */
class Troops extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'troops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'level_id'], 'integer'],
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
            'id' => 'ID',
            'title' => 'Title',
            'type_id' => 'Type ID',
            'level_id' => 'Level ID',
        ];
    }
}
