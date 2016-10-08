<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Location */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-4">
    <div class="location-form">
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
    </div>
  </div>
  <div class="col-md-8">
  <?= Html::checkboxList('materials', ArrayHelper::getColumn(app\models\ar\MaterialLocation::find()->where(['location_id'=>$model->id])->all(), 'material_id'), ArrayHelper::map(app\models\ar\Material::find ()->orderBy(['type_id'=>SORT_ASC,'title'=>SORT_ASC])->all () , 'id', 'title')) ?>
  </div>
</div>
<div class="form-group">
  <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
