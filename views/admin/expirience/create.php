<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ar\Expirience */

$this->title = Yii::t('app', 'Create Expirience');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expiriences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expirience-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
