<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = $this->title;

$expiriencesArray = ArrayHelper::map($expiriences, 'id', 'title');
?>
<div class="material-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Create Material'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
			[
				'label' => 'materialType',
				'attribute' => 'type_id',
				'header' => Yii::t('app', 'Type'),
				'value' => 'materialType.title',
				'filter' => ArrayHelper::map(app\models\ar\MaterialType::find()->all(), 'id', 'title')	
			],
			[
				'label' => 'expiriences',
				'attribute' => 'expiriences',
				'header' => Yii::t('app', 'Expiriences'),
				'value' => 'expiriences.title',
				'content' => function($data) use ($expiriencesArray){
					$expiriences = [];
					foreach(ArrayHelper::map($data->materialExpiriences, 'expirience_id', 'quantity') as $key=>$quantity){
						$expiriences[] = '<span class="label label-primary">' . $expiriencesArray[$key] . '</span>';
					}
					return implode('<div class="clearfix"></div>', $expiriences);
				}	
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
