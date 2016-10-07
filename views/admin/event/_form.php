<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(yii\helpers\ArrayHelper::map(app\models\ar\EventType::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'start')->widget('\yii\jui\DatePicker', ['dateFormat' => 'yyyy-MM-dd','options'=>['class' => 'form-control']]) ?>

    <?= $form->field($model, 'end')->widget('\yii\jui\DatePicker', ['dateFormat' => 'yyyy-MM-dd','options'=>['class' => 'form-control']]) ?>

    <?= $form->field($model, 'coverage')->dropDownList([
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
