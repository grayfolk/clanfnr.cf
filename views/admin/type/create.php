<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ar\AccessoryType */

$this->title = Yii::t('app', 'Create Accessory Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accessory Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessory-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
