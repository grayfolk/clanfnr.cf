<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_type".
 *
 * @property integer $id
 * @property string $title
 * @property integer $is_stone
 * @property integer $is_invider
 */
class MaterialType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_stone', 'is_invider'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'is_stone' => 'Is Stone',
            'is_invider' => 'Is Invider',
        ];
    }
}
