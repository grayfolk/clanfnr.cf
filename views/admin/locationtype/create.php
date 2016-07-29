<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ar\LocationType */

$this->title = Yii::t('app', 'Create Location Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Location Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
