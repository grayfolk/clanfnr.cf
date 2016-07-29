<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Locations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Location'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
				'label' => 'type',
				'attribute' => 'type',
				'header' => 'Type',
				'value' => 'type.title',
			],
			[
				'header' => 'Уровень 1'
			],
			[
				'header' => 'Уровень 2'
			],
			[
				'header' => 'Уровень 3'
			],
			[
				'header' => 'Уровень 4'
			],
			[
				'header' => 'Уровень 5'
			],
			[
				'header' => 'Уровень 6'
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
