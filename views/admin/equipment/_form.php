<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-4">
    <div class="equipment-form">
      <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
      <div class="form-group field-equipment-accessory">
        <label for="equipment-accessory" class="control-label">Accessory</label>
        <?= Html::activeDropDownList($model, 'accessory_id',
      yii\helpers\ArrayHelper::map(app\models\ar\Accessory::find()->all(), 'id', 'title'), ['class'=>'form-control']) ?>
        <div class="help-block"></div>
      </div>
      <div class="form-group field-equipment-type">
        <label for="equipment-type" class="control-label">Type</label>
        <?= Html::activeDropDownList($model, 'type_id',
      yii\helpers\ArrayHelper::map(app\models\ar\AccessoryType::find()->all(), 'id', 'title'), ['class'=>'form-control']) ?>
        <div class="help-block"></div>
      </div>
      <?= $form->field($model, 'level')->textInput() ?>
      <?= $form->field($model, 'silver')->textInput() ?>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group field-equipment-type">
      <label for="equipment-type" class="control-label">Навык</label>
      <div class="input-group">
        <?= Html::dropdownList('expiriences', null, ArrayHelper::map($expiriences, 'id', 'title'), ['class'=>'form-control']) ?>
        <span class="input-group-btn">
        <button class="btn btn-success" type="button" id="equipmentExpiriencesAdd"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
        </span> </div>
    </div>
    <div id="equipmentExpiriencesHolder">
      <?php if($expirienceData):?>
      <?php foreach($expirienceData as $row):?>
      <div class="thumbnail jsEquipmentExpiriencesItem">
        <h4><span class="title"><?= $row['title']?></span> <span class="pull-right">
          <button class="btn btn-success btn-xs jsEquipmentExpiriencesDone hide" type="button"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></button>
          <button class="btn btn-primary btn-xs jsEquipmentExpiriencesEdit" type="button"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></button>
          <button class="btn btn-danger btn-xs jsEquipmentExpiriencesRemove" type="button" data-selected="<?= $row['id']?>"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
          </span></h4>
        <table class="table table-striped table-condensed jsEquipmentExpiriencesEditArea hide">
          <?php foreach(app\models\ar\Level::find ()->orderBy(['id' => SORT_ASC])->all () as $level):?>
          <tr>
            <td><?= $level->title?></td>
            <td><div class="input-group">
                <input type="text" name="expirience[<?= $row['id']?>][<?= $level->id?>]" class="form-control" value="<?= $row['levels'][$level->id]?>">
                <span class="input-group-addon">%</span></div></td>
          </tr>
          <?php endforeach;?>
        </table>
        <table class="table table-hover table-condensed jsEquipmentExpiriencesShowArea">
          <tr>
          	<?php foreach(app\models\ar\Level::find ()->orderBy(['id' => SORT_ASC])->all () as $level):
			switch($level->id){
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
			?>
            <td class="<?= $class?>"><?= $row['levels'][$level->id]?>%</td>
            <?php endforeach;?>
          </tr>
        </table>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
