<?php

namespace app\models\ar;

use Yii;

class MaterialLocation extends \app\models\MaterialLocation
{
	
   public function getMaterial()
    {
        return $this->hasMany(Material::className(), ['material_id' => 'id']);
    }
    
    public function getLocation()
    {
        return $this->hasMany(Location::className(), ['location_id' => 'id']);
    }
    
   /* public static function getMaterialLocation($id) {
		$data = [ ];
		if ($res = static::find ()->with ( [ 
				'material',
				'location' 
		] )->where ( [ 
				'material_id' => $id 
		] )->all ()) {
			foreach ( $res as $row ) {
				if (! array_key_exists ( $row->location_id, $data ))
					$data [$row->location_id] = [ 
							'id' => $row->location_id,
							'title' => $row->location->title 
					];
					$data [$row->location_id];
			}
		}
		return $data;
	}*/
	
	
	public static function getMaterialLocation($id) {
		
		//$res = static::find ()->where ( [ 'material_id' => $id ] )->all ();
		
		$res = static::find ()->with ( [ 'material', 'location' ] )->where ( [ 'material_id' => $id ] )->all ();
		
		
	/*	$res = static::find ()->where ( [ 
				'material_id' => $id 
		] )->all ();*/
		

		return $res;
	}
	
	
	
	
	
	

}
