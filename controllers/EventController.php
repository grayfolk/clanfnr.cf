<?php

namespace app\controllers;

use Yii;
use app\components\CommonController;
use app\models\ar\Event;

class EventController extends CommonController {
	public function behaviors() {
		return [ ];
	}
	public function actionIndex() {
		return $this->render ( 'index', [ 
				'events' => Event::find ()->all () 
		] );
	}
	public function actionJsoncalendar($start = null, $end = null, $_ = null) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$times = Event::find ()->where ()->all ();
		$events = [ ];
		foreach ( $times as $time ) {
			// Testing
			$Event = new \yii2fullcalendar\models\Event ();
			$Event->id = $time->id;
			$Event->title = $time->categoryAsString;
			$Event->start = date ( 'Y-m-d\TH:i:s\Z', strtotime ( $time->date_start . ' ' . $time->time_start ) );
			$Event->end = date ( 'Y-m-d\TH:i:s\Z', strtotime ( $time->date_end . ' ' . $time->time_end ) );
			$events [] = $Event;
		}
		return $events;
	}
}
