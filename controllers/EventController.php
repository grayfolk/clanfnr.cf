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
		return $this->render ( 'index', [ ] );
	}
	public function actionJson($start = null, $end = null, $_ = null) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$times = Event::find ()->where ( [ 
				'>=',
				'start',
				date ( 'Y-m-d', strtotime ( \Yii::$app->request->post ( 'start' ) ) + 60 * 60 * 24 * 10 ) 
		] )->andWhere ( [ 
				'<=',
				'end',
				date ( 'Y-m-d', strtotime ( \Yii::$app->request->post ( 'end' ) ) - 60 * 60 * 24 * 10 ) 
		] )->all ();
		$events = [ ];
		foreach ( $times as $key => $time ) {
			$title = $description = '';
			$color = '';
			switch ($time->coverage) {
				case 'none' :
				default :
					break;
				case 'bonus' :
					$color = '#36a517';
					if ($time->quantity < 0)
						$color = '#b1f79e';
					break;
				case 'clan' :
					// $title .= '<span class="label label-primary">Клановое</span> ';
					$title .= 'Клановое: ';
					$color = '#639af2';
					break;
				case 'individual' :
					// $title .= '<span class="label label-info">Личное</span> ';
					$title .= 'Личное: ';
					$color = '#b68ad8';
					break;
				case 'global' :
					$color = '#ce4823';
					break;
			}
			if ($time->invider_id)
				$color = '#bbc4b8';
			$title .= $time->type->title;
			if ($time->invider_id)
				$title .= " (" . (\app\models\ar\Location::find ()->where ( [ 
						'id' => $time->location->id 
				] )->one ()->title) . ")";
			if ($time->coverage == 'bonus')
				$title .= " " . ($time->quantity > 0 ? "+" : '') . $time->quantity . '%';
			$Event = new \yii2fullcalendar\models\Event ();
			$Event->allDay = true;
			$Event->backgroundColor = true;
			$Event->id = $key;
			$Event->title = $title;
			// $Event->description = $description;
			$Event->color = $time->invider_id ? $color : $time->type->color;
			$Event->backgroundColor = $time->invider_id ? $color : $time->type->color;
			$Event->start = date ( 'Y-m-d\T', strtotime ( $time->start ) );
			$Event->end = date ( 'Y-m-d\T00:00:00\Z', strtotime ( $time->end ) );
			$events [] = $Event;
		}
		return $events;
	}
}
