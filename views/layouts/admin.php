<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$bodyClass = '';
$controller = Yii::$app->controller;
$default_controller = Yii::$app->defaultRoute;
if($controller->id === $default_controller && $controller->action->id === $controller->defaultAction)
	$bodyClass = 'bg';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title>
<?= Html::encode($this->title) ?>
</title>
<?php $this->head() ?>
</head>
<body class="<?= $bodyClass?>">
<?php $this->beginBody() ?>
<div class="wrap">
  <?php
    NavBar::begin([
        'brandLabel' => 'Clan FNR',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
         //  ['label' => 'Home', 'url' => ['/home/index']],
         //   ['label' => 'About', 'url' => ['/home/about']],
         //   ['label' => 'Contact', 'url' => ['/home/contact']],
			! Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin ? (
                 ['label' => 'Admin', 'url' => ['/admin']]
            ) : (
               ''
            ),
		 	Yii::$app->user->isGuest ? (
                ''
            ) : (
                ['label' => 'Profile', 'url' => ['/user/settings/profile']]
            ),
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user/security/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user/security/logout'], 'post', ['class'=>'navbar-form navbar-left'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
  <div class="container">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => Yii::t('app', 'Equipments'), 'url' => ['/admin/equipment/index']],
			['label' => Yii::t('app', 'Locations'), 'url' => ['/admin/location/index']],
			['label' => Yii::t('app', 'Materials'), 'url' => ['/admin/material/index']],
			['label' => Yii::t('app', 'Experiences'), 'url' => ['/admin/experience/index']],
			['label' => Yii::t('app', 'Events'), 'url' => ['/admin/event/index']],
			['label' => Yii::t('app', 'Event Types'), 'url' => ['/admin/event-type/index']],
			['label' => Yii::t('app', 'Another Types'), 'url' => ['#'], 'items' => [
				['label' => Yii::t('app', 'Accessories'), 'url' => ['/admin/accessory/index']],
				['label' => Yii::t('app', 'Accessory Types'), 'url' => ['/admin/accessory-type/index']],
				['label' => Yii::t('app', 'Location Types'), 'url' => ['/admin/location-type/index']],
				['label' => Yii::t('app', 'Levels'), 'url' => ['/admin/level/index']],
				['label' => Yii::t('app', 'Material Types'), 'url' => ['/admin/material-type/index']],
				['label' => Yii::t('app', 'Troops'), 'url' => ['/admin/troops/index']],
				['label' => Yii::t('app', 'Troops Types'), 'url' => ['/admin/troops-type/index']],
			]],
        ],
    ]);
    NavBar::end();
    ?>
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    <?= $content ?>
  </div>
</div>
<footer class="footer" hidden>
  <div class="container">
    <p class="pull-left">&copy; Clan FNR
      2015 &mdash; <?= date('Y') ?>
    </p>
  </div>
</footer>
<?php $this->endBody() ?>
<script>
jQuery(document).ready(function($){
	$(document).on('click', '#equipmentExperiencesAdd', function(e){
		$('#equipmentExperiencesHolder').prepend('<div class="thumbnail jsEquipmentExperiencesItem"><h4><span class="title">'+$('select[name="experiences"] option:selected').text()+'</span> <span class="pull-right"><button class="btn btn-success btn-xs jsEquipmentExperiencesDone" type="button"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></button><button class="btn btn-primary btn-xs jsEquipmentExperiencesEdit hide" type="button"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></button><button class="btn btn-danger btn-xs jsEquipmentExperiencesRemove" type="button" data-selected="'+$('select[name="experiences"]').val()+'"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button></span></h4><table class="table table-striped table-condensed jsEquipmentExperiencesEditArea"><?php foreach(app\models\ar\Level::find ()->orderBy(['id' => SORT_ASC])->all () as $level):?><tr><td><?= $level->title?></td><td><div class="input-group"><input type="text" name="experience['+$('select[name="experiences"]').val()+'][<?= $level->id?>]" class="form-control"><span class="input-group-addon">%</span></div></td></tr><?php endforeach;?></table><table class="table table-hover table-condensed jsEquipmentExperiencesShowArea hide"><tr>  <td class="active">5%</td><td>5%</td><td class="success">5%</td><td class="info">5%</td><td class="danger">5%</td><td class="warning">5%</td></tr></table></div>')
		// $('select[name="experiences"] option:selected').prop('disabled', true)
	})
	$(document).on('click', '.jsEquipmentExperiencesRemove', function(e){
		// $('select[name="experiences"] option[value="'+$(this).data('selected')+'"]').prop('disabled', false)
		$(this).parents('.jsEquipmentExperiencesItem').remove()
	})
	$(document).on('click', '.jsEquipmentExperiencesDone', function(e){
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesDone').addClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesEditArea').addClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesShowArea').removeClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesEdit').removeClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('input').each(function(){
			$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesShowArea td').eq($(this).parents('.jsEquipmentExperiencesItem').find('input').index($(this))).text($(this).val()+'%')
		})
	})
	$(document).on('click', '.jsEquipmentExperiencesEdit', function(e){
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesDone').removeClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesEditArea').removeClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesShowArea').addClass('hide')
		$(this).parents('.jsEquipmentExperiencesItem').find('.jsEquipmentExperiencesEdit').addClass('hide')
	})
	$('#equipmentExperiencesHolder').sortable()/*.disableSelection()*/
	$(document).on('click', '.jsMaterialsIncrease', function(e){
		$('input[name="material['+$(this).data('id')+']"]').val(parseInt($('input[name="material['+$(this).data('id')+']"]').val())+1)
		return false
	})
	$(document).on('click', '.jsMaterialsDecrease', function(e){
		if(parseInt($('input[name="material['+$(this).data('id')+']"]').val()) > 0)
			$('input[name="material['+$(this).data('id')+']"]').val(parseInt($('input[name="material['+$(this).data('id')+']"]').val())-1)
		return false
	})
	$(document).on('change', '#event-type_id', function(e){
		if($('#event-type_id option:selected').text() == 'Захватчик') $('div.field-event-invider_id').show()
		else $('div.field-event-invider_id').hide()
	})
	$('#event-type_id').trigger('change')
})
</script>
</body>
</html>
<?php $this->endPage() ?>
