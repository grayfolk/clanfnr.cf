<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\ar\Troops */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="troops-form">

    <?php $form = ActiveForm::begin(); ?>

    <p></p>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <p>type_id (тип войск)</p>
    
    <?= Html::activeDropDownList($model, 'type_id',
      yii\helpers\ArrayHelper::map(app\models\ar\TroopsType::find()->orderBy(['title'=>SORT_ASC])->all(), 'id', 'title'), ['class'=>'form-control']) ?>
    
    <br>
    <p>level_id (Уровень)</p>
    
    <?= Html::activeDropDownList($model, 'level_id',
      yii\helpers\ArrayHelper::map(app\models\ar\Level::find()->orderBy(['id'=>SORT_ASC])->all(), 'id', 'id'), ['class'=>'form-control']) ?>
    
    
    <br>

    <?php // echo $form->field($model, 'type_id')->textInput() ?>

    <?php // echo $form->field($model, 'level_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
