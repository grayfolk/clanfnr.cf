<?php

/* @var $this yii\web\View */
$this->title = 'Clan FNR';
?>

<?php
/*
$list = [];
if($events && count($events)){
	foreach($events as $key=>$event){
		$title = $description = '';
		$color = '';
		switch($event->coverage){
			case 'none':
			default:
				break;
			case 'bonus':
				$color = '#36a517';
				if($event->quantity < 0) $color = '#b1f79e';
				break;
			case 'clan':
				// $title .= '<span class="label label-primary">Клановое</span> ';
				$title .= 'Клановое: ';
				$color = '#639af2';
				break;
			case 'individual':
				// $title .= '<span class="label label-info">Личное</span> ';
				$title .= 'Личное: ';
				$color = '#b68ad8';
				break;
			case 'global':
				$color = '#ce4823';
				break;
		}
		if($event->invider_id) $color = '#bbc4b8';
		$title .= $event->type->title;
		if($event->invider_id) $title .= " (" . (app\models\ar\Location::find()->where(['id'=>$event->location->id])->one()->title) . ")";
		if($event->coverage == 'bonus') $title .= " " . ($event->quantity > 0 ? "+" : '') . $event->quantity . '%';
		$Event = new \yii2fullcalendar\models\Event();
		$Event->allDay = true;
		$Event->backgroundColor = true;
		$Event->id = $key;
		$Event->title = $title;
		// $Event->description = $description;
		$Event->color = $event->invider_id ? $color : $event->type->color;
		$Event->backgroundColor = $event->invider_id ? $color : $event->type->color;
		$Event->start = date('Y-m-d\T', strtotime($event->start));
		$Event->end = date('Y-m-d\T00:00:00\Z', strtotime($event->end));
		$list[] = $Event;
	}
}
*/
?>

<?= \yii2fullcalendar\yii2fullcalendar::widget([
	'events'=> [
		'url' => \yii\helpers\Url::to(['/event/index']),
		'type' => 'POST'
	],
	'options' => [
        'lang' => 'ru',
	],
	// 'ajaxEvents' => \yii\helpers\Url::to(['/event/index']),
	'header' => [
		'center'=>'title',
		'left'=>'prev,next today',        
		'right'=>'month,agendaWeek,listWeek'
	],
	// 'ajaxEvents' => yii\helpers\Url::to(['/event/index'])
]);