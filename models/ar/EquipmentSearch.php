<?php

namespace app\models\ar;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\ar\Equipment;

/**
 * EquipmentSearch represents the model behind the search form about `app\models\ar\Equipment`.
 */
class EquipmentSearch extends \app\models\EquipmentSearch {
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params        	
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Equipment::find ();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query,
				'sort' => [ 
						'defaultOrder' => [ 
								'title' => SORT_ASC 
						],
						'attributes' => [ 
								'id',
								'title',
								'level',
								'silver' 
						] 
				] 
		] );
		
		$query->with ( [ 
				'accessory' => function ($query) {
					$query->from ( [ 
							'accessory' 
					] );
				},
				'type' => function ($query) {
					$query->from ( [ 
							'accessory_type' 
					] );
				},
				'equipmentExperiences',
				'equipmentMaterials' 
		] );
		
		$this->load ( $params );
		
		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		$query->andFilterWhere ( [ 
				'id' => $this->id,
				'accessory_id' => $this->accessory_id,
				'type_id' => $this->type_id,
				'level' => $this->level,
				'silver' => $this->silver 
		] );
		
		$query->andFilterWhere ( [ 
				'like',
				'title',
				$this->title 
		] );
		
		return $dataProvider;
	}
}
