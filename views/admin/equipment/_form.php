<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
  <div class="col-md-3">
    <div class="equipment-form">
      <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
      <div class="form-group field-equipment-accessory">
        <label for="equipment-accessory" class="control-label">Accessory</label>
        <?= Html::activeDropDownList($model, 'accessory_id',
      yii\helpers\ArrayHelper::map(app\models\ar\Accessory::find()->all(), 'id', 'title'), ['class'=>'form-control']) ?>
        <div class="help-block"></div>
      </div>
      <div class="form-group field-equipment-type">
        <label for="equipment-type" class="control-label">Type</label>
        <?= Html::activeDropDownList($model, 'type_id',
      yii\helpers\ArrayHelper::map(app\models\ar\AccessoryType::find()->all(), 'id', 'title'), ['class'=>'form-control']) ?>
        <div class="help-block"></div>
      </div>
      <?= $form->field($model, 'level')->textInput() ?>
      <?= $form->field($model, 'silver')->textInput() ?>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
