<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$materialsArray = ArrayHelper::map($materials, 'id', 'title');
$expiriencesArray = ArrayHelper::map($expiriences, 'id', 'title');

$this->title = 'Clan FNR';
$expiriencesColumns = [];
if($expiriences){
	foreach($expiriences as $expirience){
		$expiriencesColumns [] = [
			'header' => $expirience->title,
			'contentOptions' =>function ($model, $key, $index, $column) use ($expirience){
				$html = '';
				$data = [];
				foreach($model->eqiupmentExpiriences as $row){
					if($row->expirience_id == $expirience->id) $data[$row->level_id] = $row->quantity;
				}
				if(count($data)){
					ksort($data);
					$html .= '<table class="table table-hover table-condensed"><tr>';
					foreach($data as $level=>$quantity){
						switch($level){
							case 1:
								$class = 'active';
								break;
							case 3:
								$class = 'success';
								break;
							case 4:
								$class = 'info';
								break;
							case 5:
								$class = 'danger';
								break;
							case 6:
								$class = 'warning';
								break;
							default:
								$class = '';
								break;
						}
						$html .= '<td class="'.$class.'">'.$quantity.'%</td>';
					}
					$html .= '</tr></table>';
				}
				return [
					'data-filter' => count($data)? $expirience->title : '',
					'data-sort' => array_key_exists(6, $data) ? $data[6]*10 : 0,
					'data-html' => $html
				];
			},
			'content' => function($model) use ($expirience){
				return '';
				$html = '';
				$data = [];
				foreach($model->eqiupmentExpiriences as $row){
					if($row->expirience_id == $expirience->id) $data[$row->level_id] = $row->quantity;
				}
				if(count($data)){
					ksort($data);
					$html .= '<table class="table table-hover table-condensed"><tr>';
					foreach($data as $level=>$quantity){
						switch($level){
							case 1:
								$class = 'active';
								break;
							case 3:
								$class = 'success';
								break;
							case 4:
								$class = 'info';
								break;
							case 5:
								$class = 'danger';
								break;
							case 6:
								$class = 'warning';
								break;
							default:
								$class = '';
								break;
						}
						$html .= '<td class="'.$class.'">'.$quantity.'%</td>';
					}
					$html .= '</tr></table>';
				}
				return $html;
			}
		];
	}
}
?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-9 col-xs-12">
  	<?php if($accessoryTypes):?>
    <?= Html::checkboxList('accessoryTypes', []/*ArrayHelper::getColumn($accessoryTypes, 'id')*/, ArrayHelper::map($accessoryTypes, 'id', 'title'), ['separator'=>' ']) ?>
    <hr>
    <?php endif;?>
    <?php if($accessories):?>
    <?= Html::checkboxList('accessories', []/*ArrayHelper::getColumn($accessories, 'id')*/, ArrayHelper::map($accessories, 'id', 'title'), ['separator'=>' ']) ?>
    <hr>
    <?php endif;?>
    <div class="btn-group btn-group-justified visible-xs" role="group">
      <?php if($expiriences):?>
      <a class="btn btn-primary" data-toggle="modal" data-target="#expiriencesModal"><?= Yii::t('app', 'Expiriences')?></a>
      <?php endif;?>
      <?php if($materials):?>
      <a class="btn btn-primary" data-toggle="modal" data-target="#materialsModal"><?= Yii::t('app', 'Materials')?></a>
      <?php endif;?>
    </div>
    <hr class=" visible-xs">
    <div class="equipment-index">
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'layout' => '{items}',
        'columns' => array_merge(
			[[
				'header' => Yii::t('app', 'Title'),
				'content' => function($data) use ($expiriencesArray){
					$html = "";
					$expiriences = [];
					foreach(ArrayHelper::map($data->eqiupmentExpiriences, 'expirience_id', 'quantity') as $key=>$quantity){
						$html .= $expiriencesArray[$key] . "<table class='table table-condensed'><tr>";
						$expiriencesData = [];
						foreach($data->eqiupmentExpiriences as $row){
							if($row->expirience_id == $key) $expiriencesData[$row->level_id] = $row->quantity;
						}
						if(count($expiriencesData)){
							ksort($expiriencesData);
							foreach($expiriencesData as $level=>$quantity){
								switch($level){
									case 1:
										$class = 'active';
										break;
									case 3:
										$class = 'success';
										break;
									case 4:
										$class = 'info';
										break;
									case 5:
										$class = 'danger';
										break;
									case 6:
										$class = 'warning';
										break;
									default:
										$class = '';
										break;
								}
								$html .= "<td class='".$class."'>".$quantity."%</td>";
							}
							$html .= '</tr></table>';
						}
					}
					return '<a tabindex="-1" role="button" data-toggle="popover" title="' . $data->title . '" data-content="' .$html . '">' . $data->title . '</a>';
				}
			],
			[
				'header' => Yii::t('app', 'Type'),
				'content' => function($data){
					return implode(' ', [
						$data->accessory ? '<span class="label label-info">' . $data->accessory->title . '</span>' : '',
						$data->type ? '<span class="label label-default">' . $data->type->title . '</span>' : ''
					]);
				}
			],
            'level',
			'accessory_id',
			'type_id'],
			$expiriencesColumns,
			[[
			 	'label' => 'silver',
				'attribute' => 'silver',
			 	'header' => Yii::t('app', 'Silver'),
				'contentOptions' =>function ($model, $key, $index, $column){
					return [
						'data-sort' => $model->silver
					];
				},
				'content' => function($data){
					return app\helpers\CommonHelper::thousandsCurrencyFormat($data->silver);
				}
			]],
			[[
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
			]]
		),
    ]); ?>
    </div>
  </div>
  <div class="col-md-3 hidden-xs">
    <div class="page-header">
      <h4>
        <?= Yii::t('app', 'Expiriences')?> <small><label> And/Or<input type="checkbox" class="jsExpiriencesBoolean"></label></small>
      </h4>
    </div>
    <?= Html::checkboxList('expiriences', null, ArrayHelper::map($expiriences, 'id', 'title'), ['separator'=>'<br>']) ?>
    <button type="button" class="btn btn-primary btn-sm resetExpiriences">
    <?= Yii::t('app', 'Reset')?>
    </button>
    <div class="page-header">
      <h4>
        <?= Yii::t('app', 'Materials')?>
      </h4>
    </div>
    <?= Html::checkboxList('materials', null, ArrayHelper::map($materials, 'id', 'title'), ['separator'=>'<br>']) ?>
    <button type="button" class="btn btn-primary btn-sm resetMaterials">
    <?= Yii::t('app', 'Reset')?>
    </button>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="expiriencesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="<?= Yii::t('app', 'Close')?>"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          <?= Yii::t('app', 'Expiriences')?> <small><label> And/Or<input type="checkbox" class="jsExpiriencesBoolean"></label></small>
        </h4>
      </div>
      <div class="modal-body">
        <?= Html::checkboxList('expiriencesModal', null, ArrayHelper::map($expiriences, 'id', 'title'), ['separator'=>'<br>']) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <?= Yii::t('app', 'Close')?>
        </button>
        <button type="button" class="btn btn-primary resetExpiriences">
        <?= Yii::t('app', 'Reset')?>
        </button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="materialsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="<?= Yii::t('app', 'Close')?>"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          <?= Yii::t('app', 'Materials')?>
        </h4>
      </div>
      <div class="modal-body">
        <?= Html::checkboxList('materialsModal', null, ArrayHelper::map($materials, 'id', 'title'), ['separator'=>'<br>']) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <?= Yii::t('app', 'Close')?>
        </button>
        <button type="button" class="btn btn-primary resetMaterials">
        <?= Yii::t('app', 'Reset')?>
        </button>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
