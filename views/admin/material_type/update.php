<?php

use yii\helpers\Html;

/*Базовый файл*/
/* @var $this yii\web\View */
/* @var $model app\models\MaterialType */

$this->title = 'Update Material Type: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Material Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
