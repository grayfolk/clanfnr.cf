<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property integer $type_id
 * @property string $start
 * @property string $end
 * @property string $coverage
 * @property integer $quantity
 * @property integer $invider_id
 *
 * @property EventType $type
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'start', 'coverage'], 'required'],
            [['type_id', 'quantity', 'invider_id'], 'integer'],
            [['start', 'end'], 'safe'],
            [['coverage'], 'string', 'max' => 32],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => Yii::t('app', 'Type ID'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'coverage' => Yii::t('app', 'Coverage'),
            'quantity' => Yii::t('app', 'Quantity'),
            'invider_id' => Yii::t('app', 'Invider ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'type_id']);
    }

    /**
     * @inheritdoc
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
}
