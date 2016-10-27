<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\ar\Troops */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="troops-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'type_id')->label(Yii::t('app', 'Troops Type'))->dropDownList(yii\helpers\ArrayHelper::map(app\models\ar\TroopsType::find()->orderBy(['title'=>SORT_ASC])->all(), 'id', 'title'), ['class'=>'form-control']) ?>
    
    <?= $form->field($model, 'level_id')->label(Yii::t('app', 'Troops Level'))->dropDownList(yii\helpers\ArrayHelper::map(app\models\ar\Level::find()->where(['<','id',6])->orderBy(['id'=>SORT_ASC])->all(), 'id', function($model, $defaultValue){return 'T' . $model['id'];}), ['class'=>'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
