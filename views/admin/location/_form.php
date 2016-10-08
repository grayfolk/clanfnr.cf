<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
    'options' => ['placeholder' => 'Select color ...'],
])?>

     <div class="form-group field-location-type">
    <label for="location-type" class="control-label">Type</label>
    <?= Html::activeDropDownList($model, 'type_id',
      yii\helpers\ArrayHelper::map(app\models\ar\LocationType::find()->all(), 'id', 'title'), ['class'=>'form-control']) ?>
    <div class="help-block"></div>
  </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
