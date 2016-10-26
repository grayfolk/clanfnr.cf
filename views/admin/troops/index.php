<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Troops');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="troops-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Troops'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
           
			[
				'label' => 'troopsType',
				'attribute' => 'type_id',
				'header' => Yii::t('app', 'Type'),
				'value' => 'troopsType.title',
				'filter' => ArrayHelper::map(app\models\ar\TroopsType::find()->all(), 'id', 'title')	
			],
			
			[
				'label' => 'level',
				'attribute' => 'type_id',
				'header' => Yii::t('app', 'Level'),
				'value' => 'level.title',
				'filter' => ArrayHelper::map(app\models\ar\Level::find()->all(), 'id', 'title')	
			],
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
