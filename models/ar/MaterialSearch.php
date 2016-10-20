<?php

namespace app\models\ar;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\ar\Material;

class MaterialSearch extends \app\models\MaterialSearch {
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params        	
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Material::find ();
		
		// add conditions that should always apply here
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		$this->load ( $params );
		
		if (! $this->validate ()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		// grid filtering conditions
		/* $query->andFilterWhere ( [ 
				'id' => $this->id,
				'is_stone' => $this->is_stone,
				'is_invider' => $this->is_invider,
				'type_id' => $this->type_id 
		] ); */
		$query->andFilterWhere ( [ 
				'type_id' => $this->type_id 
		] );
		
		$query->andFilterWhere ( [ 
				'like',
				'title',
				$this->title 
		] );
		
		return $dataProvider;
	}
}
