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
var expirienceTable, expirienceColumns = range(3,36)
jQuery(document).ready(function($){
	expirienceTable = $('.equipment-index table').DataTable({
		// responsive: true,
		scrollX: true,
		language: {
			url: '//cdn.datatables.net/plug-ins/1.10.12/i18n/Russian.json'
		},
		order: [
			[ 2, "desc" ],
			[ 0, "asc" ]
		],
		pageLength: 50,
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= Yii::t('app', 'All')?>"]],
		columnDefs: [
			{ 
				visible: false,
				targets: expirienceColumns,
			},
			{ 
				sortable: false,
				targets: [1,37],
			}
		],
	})
	.on('order.dt', function(){
		popover()
		$('td[data-html]').each(function(){
			$(this).html($(this).data('html'))
		})
	})
	.on('search.dt', function(){
		popover()
		$('td[data-html]').each(function(){
			$(this).html($(this).data('html'))
		})
	})
	.on('page.dt', function(){
		popover()
		$('td[data-html]').each(function(){
			$(this).html($(this).data('html'))
		})
	})
	$(document).on('click', 'input[name="expiriencesModal[]"]', function(e){
		$('input[name="expiriences[]"]').eq($('input[name="expiriencesModal[]"]').index($(this))).trigger('click')
	})
	$(document).on('click', 'input[name="materialsModal[]"]', function(e){
		$('input[name="materials[]"]').eq($('input[name="materialsModal[]"]').index($(this))).trigger('click')
	})
	$(document).on('click', 'input[name="materials[]"]', function(e){
		$('input[name="materialsModal[]"]').eq($('input[name="materials[]"]').index($(this))).prop('checked', $(this).is(':checked'))
		triggerFilters()
	})
	$(document).on('click', 'input[name="expiriences[]"]', function(e){
		$('input[name="expiriencesModal[]"]').eq($('input[name="expiriences[]"]').index($(this))).prop('checked', $(this).is(':checked'))
		expirienceTable.column($('input[name="expiriences[]"]').index($(this))+5).visible($(this).is(':checked'))
		triggerFilters()
	})
	$(document).on('click', 'input[name="accessoryTypes[]"], input[name="accessories[]"]', function(e){
		triggerFilters()
	})
	$(document).on('click', '.resetExpiriences', function(e){
		$('input[name="expiriences[]"], input[name="expiriencesModal[]"]').prop('checked', false)
		expirienceTable.columns(expirienceColumns).visible(false)
		triggerFilters()
	})
	$(document).on('click', '.resetMaterials', function(e){
		$('input[name="materials[]"], input[name="materialsModal[]"]').prop('checked', false)
		triggerFilters()
	})
	$('input[name="expiriences[]"]:checked').each(function(){
		expirienceTable.column($('input[name="expiriences[]"]').index($(this))+5).visible($(this).is(':checked'))
	})
	$(document).on('change', '.jsExpiriencesBoolean', function(e){
		$('.jsExpiriencesBoolean').prop('checked', $(this).is(':checked'))
		triggerFilters()
	})
	triggerFilters()
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
	var expiriences = $('input[name="expiriences[]"]:checked').map(function(i, e){ 
		return $(e).parents('label').text().trim()
	}).get().join('|')
	var materials = $('input[name="materials[]"]:checked').map(function(i, e){ 
		return $(e).parents('label').text().trim()
	}).get().join('|')
	var accessories = $('input[name="accessories[]"]:checked').map(function(i, e){ 
		return $(e).val()
	}).get().join('|')
	var accessoryTypes = $('input[name="accessoryTypes[]"]:checked').map(function(i, e){ 
		return $(e).val()
	}).get().join('|')
	expirienceTable.column(3).search(accessories, true, true)
	expirienceTable.column(4).search(accessoryTypes, true, true)
	expirienceTable.column(37).search(materials, true, true)
	expirienceTable.search(expiriences, true, $('.jsExpiriencesBoolean').is(':checked'))
	expirienceTable.draw()
	$('td[data-html]').each(function(){
		$(this).html($(this).data('html'))
	})
	expirienceTable.draw()
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
