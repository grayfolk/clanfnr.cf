<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Equipments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Equipment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
				'label' => 'accessory',
				'attribute' => 'accessory',
				'header' => 'Accessory',
				'value' => 'accessory.title',
			],
             [
			 	'label' => 'type',
				'attribute' => 'type',
			 	'header' => 'Type',
				'value' =>'type.title'
			],
            'level',
             [
			 	'label' => 'silver',
				'attribute' => 'silver',
			 	'header' => 'Silver',
				'value' => function($data){
					return app\helpers\CommonHelper::thousandsCurrencyFormat($data->silver);
				}
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
