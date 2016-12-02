<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = $this->title;

$experiencesArray = ArrayHelper::map($experiences, 'id', 'title');
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
				'label' => 'experiences',
				'attribute' => 'experiences',
				'header' => Yii::t('app', 'Experiences'),
				'value' => 'experiences.title',
				'content' => function($data) use ($experiencesArray){
					$experiences = [];
					foreach(ArrayHelper::map($data->materialExperiences, 'experience_id', 'quantity') as $key=>$quantity){
						$experiences[] = '<span class="label label-primary">' . $experiencesArray[$key] . '</span>';
					}
					return implode('<div class="clearfix"></div>', $experiences);
				}	
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
