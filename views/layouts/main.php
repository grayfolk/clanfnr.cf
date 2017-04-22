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
// $bodyClass = 'bg-soft';
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
<style type="text/css">
.dataTables_filter{
	display:none;
}
</style>
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
        'options' => ['class' => 'navbar-nav'],
        'items' => [
			['label' => Yii::t('app', 'Materials'), 'url' => ['/material/index']],
			['label' => Yii::t('app', 'Events'), 'url' => ['/event/index']],
			['label' => Yii::t('app', 'Equipments'), 'url' => ['/equipment/index']],
			// ['label' => Yii::t('app', 'Materials'), 'url' => ['/material/index']],
			// ['label' => Yii::t('app', 'Inviders'), 'url' => ['/inviders/index']],
			// ['label' => Yii::t('app', 'Map'), 'url' => ['/map/index']],
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
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    <?= $content ?>
  </div>
</div>
<footer class="footer hidden">
  <div class="container">
    <p class="pull-left">&copy; <a href="<?= yii\helpers\Url::home(true)?>">Clan FNR</a>
      2015 &ndash; <?= date('Y') ?>
    </p>
  </div>
</footer>
<?php $this->endBody() ?>
<script>
var experienceCount = <?= app\models\ar\Experience::find()->count()?>, firstColumns = <?= $this->params['firstColumns']?>, experienceTable, experienceColumns = range(firstColumns,experienceCount+firstColumns)
jQuery(document).ready(function($){
	experienceTable = $('.equipment-index table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			// url: '/equipment/json',
			type: 'POST',
			data: function(d){
				return $.extend({}, d, {
					form: $('#w0').serialize()
				})
			}
		},
		scrollX: true,
		language: {
			url: '//cdn.datatables.net/plug-ins/1.10.12/i18n/Russian.json'
		},
		order: [
			[ 2, "desc" ],
			[ 0, "asc" ]
		],
		// colReorder: true,
		pageLength: 50,
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= Yii::t('app', 'All')?>"]],
		columnDefs: [
			{ 
				visible: false,
				targets: experienceColumns,
			},
			{ 
				sortable: false,
				targets: [1,35,36],
			}
		],
	})
	.on('draw.dt', function(){
		popover()
		$('html, body').animate({
			scrollTop: 0
		}, 200)
	})
	$(document).on('click', 'input[name="experiencesModal[]"]', function(e){
		$('input[name="experiences[]"]').eq($('input[name="experiencesModal[]"]').index($(this))).trigger('click')
	})
	$(document).on('click', 'input[name="materialsModal[]"]', function(e){
		$('input[name="materials[]"]').eq($('input[name="materialsModal[]"]').index($(this))).trigger('click')
	})
	$(document).on('click', 'input[name="materials[]"]', function(e){
		$('input[name="materialsModal[]"]').eq($('input[name="materials[]"]').index($(this))).prop('checked', $(this).is(':checked'))
		triggerFilters()
	})
	$(document).on('click', 'input[name="experiences[]"]', function(e){
		$('input[name="experiencesModal[]"]').eq($('input[name="experiences[]"]').index($(this))).prop('checked', $(this).is(':checked'))
		experienceTable.column($('input[name="experiences[]"]').index($(this))+firstColumns).visible($(this).is(':checked'))
		experienceTable.order([
			[ 2, "desc" ],
			[ 0, "asc" ]
		])
		triggerFilters()
	})
	$(document).on('click', 'input[name="accessoryTypes[]"], input[name="accessories[]"]', function(e){
		triggerFilters()
	})
	$(document).on('click', '.resetExperiences', function(e){
		$('input[name="experiences[]"], input[name="experiencesModal[]"]').prop('checked', false)
		experienceTable.columns(experienceColumns).visible(false)
		triggerFilters()
	})
	$(document).on('click', '.resetMaterials', function(e){
		$('input[name="materials[]"], input[name="materialsModal[]"]').prop('checked', false)
		triggerFilters()
	})
	$(document).on('change', '.jsExperiencesBoolean', function(e){
		experienceTable.order([
			[ 2, "desc" ],
			[ 0, "asc" ]
		])
		$('.jsExperiencesBoolean').prop('checked', $(this).is(':checked'))
		triggerFilters()
	})
	popover()
	$('body').on('click', function (e) {
		$('[data-toggle="popover"]').each(function () {
			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				$(this).popover('hide');
			}
		})
	})
})
function triggerFilters(){
	experienceTable.ajax.reload(null, false)
}
function popover(){
	$('[data-toggle="popover"]').popover({
		trigger: 'click',
		placement: 'auto',
		container: 'body',
		html: true
	})
}
function range(start, end) {
    return Array(end-start).join(0).split(0).map(function(val, id) {return id+start})
}
</script>
</body>
</html>
<?php $this->endPage() ?>
