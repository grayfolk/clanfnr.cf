<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Equipments');
$this->params['breadcrumbs'][] = $this->title;

$materialsArray = ArrayHelper::map($materials, 'id', 'title');
$experiencesArray = ArrayHelper::map($experiences, 'id', 'title');
?>
<div class="equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Equipment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
				'label' => 'accessory',
				'attribute' => 'accessory',
				'header' => Yii::t('app', 'Accessory'),
				// 'value' => 'accessory.title',
				'content' => function($data){
					return $data->accessory ? $data->accessory->title : '';
				}
			],
             [
			 	'label' => 'type',
				'attribute' => 'type',
			 	'header' => Yii::t('app', 'Type'),
				// 'value' => 'type.title',
				'content' => function($data){
					return $data->type ? $data->type->title : '';
				}
			],
			[
			 	'label' => 'experiences',
				'attribute' => 'experiences',
			 	'header' => Yii::t('app', 'Experiences'),
				'content' => function($data) use ($experiencesArray){
					$experiences = [];
					foreach(ArrayHelper::map($data->equipmentExperiences, 'experience_id', 'quantity') as $key=>$quantity){
						$experiences[] = '<span class="label label-primary">' . $experiencesArray[$key] . '</span>';
					}
					return implode('<div class="clearfix"></div>', $experiences);
				}
			],
			[
			 	'label' => 'materials',
				'attribute' => 'materials',
			 	'header' => Yii::t('app', 'Materials'),
				'content' => function($data) use ($materialsArray){
					$materials = [];
					foreach(ArrayHelper::map($data->equipmentMaterials, 'material_id', 'quantity') as $key=>$quantity){
						$materials[] = $materialsArray[$key] . ( $quantity > 1 ? " ($quantity)" : '' );
					}
					return '<span style="white-space:nowrap">' . implode(', ', $materials) . '</span>';
				}
			],
            'level',
             [
			 	'label' => 'silver',
				'attribute' => 'silver',
			 	'header' => Yii::t('app', 'Silver'),
				'value' => function($data){
					if($data->silver) return app\helpers\CommonHelper::thousandsCurrencyFormat($data->silver);
				}
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
