<?php
use yii\db\Migration;
class m160728_011258_equipment_data_tables extends Migration {
	public function up() {
		$this->createTable ( 'eqiupment_material', [ 
				'equipment_id' => $this->integer ( 11 ),
				'material_id' => $this->integer ( 11 ),
				'quantity' => $this->integer () 
		] );
		$this->createTable ( 'eqiupment_expirience', [ 
				'equipment_id' => $this->integer ( 11 ),
				'expirience_id' => $this->integer ( 11 ),
				'level_id' => $this->integer ( 11 ),
				'quantity' => $this->double ( 1 ) 
		] );
		$this->addPrimaryKey ( '', 'eqiupment_material', [ 
				'equipment_id',
				'material_id' 
		] );
		$this->addPrimaryKey ( '', 'eqiupment_expirience', [ 
				'equipment_id',
				'expirience_id',
				'level_id' 
		] );
	}
	public function down() {
		echo "m160728_011258_equipment_data_tables cannot be reverted.\n";
		return false;
	}
}
