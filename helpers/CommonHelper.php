<?php

namespace app\helpers;

use yii\helpers\ArrayHelper;
class CommonHelper {
	/**
	 *
	 * @param array $data        	
	 * @return string
	 */
	public static function createExpirienceTable($data) {
		$html = '';
		if (! count ( $data ))
			return $html;
		ksort ( $data );
		$html .= '<table class="table table-hover table-condensed"><tr>';
		foreach ( $data as $level => $quantity ) {
			switch ($level) {
				case 1 :
					$class = 'active';
					break;
				case 3 :
					$class = 'success';
					break;
				case 4 :
					$class = 'info';
					break;
				case 5 :
					$class = 'danger';
					break;
				case 6 :
					$class = 'warning';
					break;
				default :
					$class = '';
					break;
			}
			$html .= '<td class="' . $class . '">' . $quantity . '%</td>';
		}
		$html .= '</tr></table>';
		return $html;
	}
	public static function createExpiriencesTable($model, $expiriencesArray) {
		$html = "";
		$expiriences = [ ];
		foreach ( ArrayHelper::map ( $model->eqiupmentExpiriences, 'expirience_id', 'quantity' ) as $key => $quantity ) {
			$html .= $expiriencesArray [$key];
			$expiriencesData = [ ];
			foreach ( $model->eqiupmentExpiriences as $row ) {
				if ($row->expirience_id == $key)
					$expiriencesData [$row->level_id] = $row->quantity;
			}
			$html .= htmlspecialchars ( self::createExpirienceTable ( $expiriencesData ) );
		}
		return $html;
	}
	public static function thousandsCurrencyFormat($num) {
		if ($num < 1000)
			return $num;
		$x = round ( $num );
		$x_number_format = number_format ( $x );
		$x_array = explode ( ',', $x_number_format );
		$x_parts = array (
				'K',
				'M',
				'B',
				'T' 
		);
		$x_count_parts = count ( $x_array ) - 1;
		$x_display = $x;
		$x_display = $x_array [0] . (( int ) $x_array [1] [0] !== 0 ? '.' . $x_array [1] [0] : '');
		$x_display .= $x_parts [$x_count_parts - 1];
		return $x_display;
	}
}