<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_location".
 *
 * @property integer $material_id
 * @property integer $location_id
 */
class MaterialLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material_id', 'location_id'], 'required'],
            [['material_id', 'location_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_id' => 'Material ID',
            'location_id' => 'Location ID',
        ];
    }
}
