<?php

use yii\helpers\Html;
use yii\grid\GridView;

/*Базовый файл*/
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Material Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Material Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'is_stone',
            'is_invider',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
