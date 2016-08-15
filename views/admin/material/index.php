<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Material'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
			[
				'label' => 'type',
				'attribute' => 'type',
				'header' => Yii::t('app', 'Type'),
				'content' => function($data){
					return $data->is_stone ? '<span class="label label-primary">Камень</span>' : '';
				}
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
