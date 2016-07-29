<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ar\Accessory */

$this->title = Yii::t('app', 'Create Accessory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accessories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
