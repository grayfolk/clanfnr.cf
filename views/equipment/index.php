<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$materialsArray = ArrayHelper::map($materials, 'id', 'title');
$experiencesArray = ArrayHelper::map($experiences, 'id', 'title');

$this->title = 'Clan FNR';
$experiencesColumns = [];
if($experiences){
	foreach($experiences as $experience){
		$experiencesColumns [] = [
			'header' => $experience->title,
			'contentOptions' =>function ($model, $key, $index, $column) use ($experience){
				$data = [];
				foreach($model->equipmentExperiences as $row){
					if($row->experience_id == $experience->id) $data[$row->level_id] = $row->quantity;
				}
				return [
					'data-filter' => count($data) ? $experience->title : null,
					// 'data-filter' => count($data) ? 'experience_' . $experience->id : null,
					'data-sort' => array_key_exists(6, $data) ? $data[6]*10 : 0,
					'data-html' => \app\helpers\CommonHelper::createExperienceTable($data),
					'data-id' => count($data) ? $experience->id : null,
					// 'class' => count($data) ? 'experienceColumns' : null
				];
			},
			'content' => function($model) use ($experience){
				return '';
				$data = [];
				foreach($model->equipmentExperiences as $row){
					if($row->experience_id == $experience->id) $data[$row->level_id] = $row->quantity;
				}
				return count($data) ? 'experience_' . $experience->id : '';
				// $html = count($data) ? $experience->title : null;
				return \app\helpers\CommonHelper::createExperienceTable($data);
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
      <?php if($experiences):?>
      <a class="btn btn-primary" data-toggle="modal" data-target="#experiencesModal"><?= Yii::t('app', 'Experiences')?></a>
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
				'contentOptions' =>function ($model, $key, $index, $column) use ($experience){
					return [
						'data-sort' =>  $model->title
					];
				},
				'content' => function($data) use ($experiencesArray){
					$html = "";
					$experiences = [];
					foreach(ArrayHelper::map($data->equipmentExperiences, 'experience_id', 'quantity') as $key=>$quantity){
						$html .= $experiencesArray[$key];
						$experiencesData = [];
						foreach($data->equipmentExperiences as $row){
							if($row->experience_id == $key) $experiencesData[$row->level_id] = $row->quantity;
						}
						$html .= htmlspecialchars(\app\helpers\CommonHelper::createExperienceTable($experiencesData));
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
			/*'accessory_id',
			'type_id'*/],
			$experiencesColumns,
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
					foreach(ArrayHelper::map($data->equipmentMaterials, 'material_id', 'quantity') as $key=>$quantity){
						$materials[] = $materialsArray[$key] . ( $quantity > 1 ? " ($quantity)" : '' );
					}
					return '<span style="white-space:nowrap">' . implode(', ', $materials) . '</span>';
				}
			],
			/*[
				'header' => Yii::t('app', 'Title'),
				'content' => function($data) use ($experiencesArray){
					$html = "";
					$experiences = [];
					foreach(ArrayHelper::map($data->equipmentExperiences, 'experience_id', 'quantity') as $key=>$quantity){
						$experiences[] = $experiencesArray[$key];
					}
					return implode('|', $experiences);
				}
			]*/]
		),
    ]); ?>
    </div>
  </div>
  <div class="col-md-3 hidden-xs">
    <div class="page-header">
      <h4>
        <?= Yii::t('app', 'Experiences')?> <small><label> And/Or<input type="checkbox" class="jsExperiencesBoolean" name="experienceAnd"></label></small>
      </h4>
    </div>
    <?= Html::checkboxList('experiences', null, ArrayHelper::map($experiences, 'id', 'title'), ['separator'=>'<br>']) ?>
    <button type="button" class="btn btn-primary btn-sm resetExperiences">
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
<div class="modal fade" tabindex="-1" role="dialog" id="experiencesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="<?= Yii::t('app', 'Close')?>"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          <?= Yii::t('app', 'Experiences')?> <small><label> And/Or<input type="checkbox" class="jsExperiencesBoolean" value="experienceAnd"></label></small>
        </h4>
      </div>
      <div class="modal-body">
        <?= Html::checkboxList('experiencesModal', null, ArrayHelper::map($experiences, 'id', 'title'), ['separator'=>'<br>']) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <?= Yii::t('app', 'Close')?>
        </button>
        <button type="button" class="btn btn-primary resetExperiences">
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
