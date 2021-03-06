<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ar\Experience */

$this->title = Yii::t('app', 'Create Experience');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experience-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
