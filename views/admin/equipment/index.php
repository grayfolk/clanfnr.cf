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
				'value' => function($data){
					if(count($data->eqiupmentExpiriences)){
						$count = [];
						foreach($data->eqiupmentExpiriences as $row){
							$count[$row->expirience_id] = 1;
						}
						return count($count);
					}
					return '';
				}
			],
			[
			 	'label' => 'materials',
				'attribute' => 'materials',
			 	'header' => Yii::t('app', 'Materials'),
				'value' => function($data){
					if(count($data->eqiupmentMaterials)){
						$count = [];
						foreach($data->eqiupmentMaterials as $row){
							$count[$row->material_id] = 1;
						}
						return count($count);
					}
					return '';
				}
			],
            'level',
             [
			 	'label' => 'silver',
				'attribute' => 'silver',
			 	'header' => Yii::t('app', 'Silver'),
				'value' => function($data){
					return app\helpers\CommonHelper::thousandsCurrencyFormat($data->silver);
				}
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
