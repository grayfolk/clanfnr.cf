<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(yii\helpers\ArrayHelper::map(app\models\ar\EventType::find()->orderBy(['title'=>SORT_ASC])->all(), 'id', 'title')) ?>
    
    <?= $form->field($model, 'invider_id')->dropDownList(yii\helpers\ArrayHelper::map(app\models\ar\Location::find()->where(['type_id'=>app\models\ar\LocationType::find()->where(['title'=>'Захватчик'])->one()->id])->orderBy(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>'Select']) ?>

    <?= $form->field($model, 'start')->widget('\yii\jui\DatePicker', ['dateFormat' => 'yyyy-MM-dd','options'=>['class' => 'form-control']]) ?>

    <?= $form->field($model, 'end')->widget('\yii\jui\DatePicker', ['dateFormat' => 'yyyy-MM-dd','options'=>['class' => 'form-control']]) ?>

    <?= $form->field($model, 'coverage')->dropDownList([
		'none'=>Yii::t('app', 'None'),
		'bonus'=>Yii::t('app', 'Bonus'),
		'clan'=>Yii::t('app', 'Clan'),
		'individual'=>Yii::t('app', 'Individual'),
		'global'=>Yii::t('app', 'Global')
		]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
