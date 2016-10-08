<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%event_type}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Event[] $events
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EventTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventTypeQuery(get_called_class());
    }
}
