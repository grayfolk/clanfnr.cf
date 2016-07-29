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
                 ['label' => 'Admin', 'url' => ['/admin/index']]
            ) : (
               ''
            ),
		 	Yii::$app->user->isGuest ? (
                ''
            ) : (
                ['label' => 'Profile', 'url' => ['/user/settings/profile']]
            ),
            Yii::$app->user->isGuest ? (
                '' //['label' => 'Login', 'url' => ['/user/security/login']]
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
            ['label' => Yii::t('app', 'Accessories'), 'url' => ['/admin/accessory/index']],
            ['label' => Yii::t('app', 'Accessory types'), 'url' => ['/admin/type/index']],
			['label' => Yii::t('app', 'Locations'), 'url' => ['/admin/location/index']],
			['label' => Yii::t('app', 'Location Types'), 'url' => ['/admin/locationtype/index']],
			['label' => Yii::t('app', 'Levels'), 'url' => ['/admin/level/index']],
			['label' => Yii::t('app', 'Materials'), 'url' => ['/admin/material/index']],
			['label' => Yii::t('app', 'Expiriences'), 'url' => ['/admin/expirience/index']],
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
</body>
</html>
<?php $this->endPage() ?>
