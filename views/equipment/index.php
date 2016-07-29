<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clan FNR';
$expiriencesColumns = [];
foreach($expiriences as $expirience){
	$expiriencesColumns [] = [
		'header' => $expirience->title,
		'contentOptions' =>function ($model, $key, $index, $column){
			return [
				'data-sort' => 1,
				'data-filter' => 1,
				'data-html' => '<table class="table table-hover table-condensed">
			<tr>
			<td class="active">5%</td>
			<td>5%</td>
			<td class="success">5%</td>
			<td class="info">5%</td>
			<td class="danger">5%</td>
			<td class="warning">5%</td>
			</tr>
			</table>'
			];
		},
		'format' => 'html',
		'content' => function($data){
			return '';
			// return app\helpers\CommonHelper::thousandsCurrencyFormat($data->silver);
			return '<table class="table table-hover table-condensed">
			<tr>
			<td class="active">5%</td>
			<td>5%</td>
			<td class="success">5%</td>
			<td class="info">5%</td>
			<td class="danger">5%</td>
			<td class="warning">5%</td>
			</tr>
			</table>';
		}
	];
}
?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-9">
    <?= Html::checkboxList('accessoryTypes', []/*ArrayHelper::getColumn($accessoryTypes, 'id')*/, ArrayHelper::map($accessoryTypes, 'id', 'title'), ['separator'=>' ']) ?>
    <hr>
    <?= Html::checkboxList('accessories', []/*ArrayHelper::getColumn($accessories, 'id')*/, ArrayHelper::map($accessories, 'id', 'title'), ['separator'=>' ']) ?>
    <hr>
    <div class="equipment-index">
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => array_merge(
			['title',
            'level',
			'accessory_id',
			'type_id'],
			$expiriencesColumns,
			[[
			 	'label' => 'silver',
				'attribute' => 'silver',
			 	'header' => 'Silver',
				'contentOptions' =>function ($model, $key, $index, $column){
					return [
						'data-sort' => $model->silver
					];
				},
				'content' => function($data){
					return app\helpers\CommonHelper::thousandsCurrencyFormat($data->silver);
				}
			]]
		),
    ]); ?>
    </div>
  </div>
  <div class="col-md-3">
    <div class="page-header">
      <h4>Навыки</h4>
    </div>
    <?= Html::checkboxList('expiriences', null, ArrayHelper::map($expiriences, 'id', 'title'), ['separator'=>'<br>']) ?>
    <button type="button" id="resetExpiriences" class="btn btn-primary btn-sm"><?= Yii::t('app', 'Reset')?></button>
  </div>
</div>
<?php ActiveForm::end(); ?>
