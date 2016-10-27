<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Troops */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Troops',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Troops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="troops-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
