<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Equipments');
$this->params['breadcrumbs'][] = $this->title;

$materialsArray = ArrayHelper::map($materials, 'id', 'title');
$expiriencesArray = ArrayHelper::map($expiriences, 'id', 'title');
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
				'header' => Yii::t('app', 'Accessory'),
				'value' => 'accessory.title',
			],
             [
			 	'label' => 'type',
				'attribute' => 'type',
			 	'header' => Yii::t('app', 'Type'),
				'value' =>'type.title'
			],
			[
			 	'label' => 'expiriences',
				'attribute' => 'expiriences',
			 	'header' => Yii::t('app', 'Expiriences'),
				'content' => function($data) use ($expiriencesArray){
					$expiriences = [];
					foreach(ArrayHelper::map($data->eqiupmentExpiriences, 'expirience_id', 'quantity') as $key=>$quantity){
						$expiriences[] = '<span class="label label-primary">' . $expiriencesArray[$key] . '</span>';
					}
					return implode('<div class="clearfix"></div>', $expiriences);
				}
			],
			[
			 	'label' => 'materials',
				'attribute' => 'materials',
			 	'header' => Yii::t('app', 'Materials'),
				'content' => function($data) use ($materialsArray){
					$materials = [];
					foreach(ArrayHelper::map($data->eqiupmentMaterials, 'material_id', 'quantity') as $key=>$quantity){
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
