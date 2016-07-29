<?php
use yii\db\Migration;
class m160726_225424_equipment_tables_data extends Migration {
	public function up() {
		$this->alterColumn ( 'equipment', 'accessory', $this->integer ( 11 ) );
		$this->alterColumn ( 'equipment', 'type', $this->integer ( 11 ) );
		$this->createTable ( 'accessory', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
		$this->createTable ( 'accessory_type', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
		$this->createIndex ( 'accessory', 'equipment', 'accessory' );
		$this->createIndex ( 'accessory_type', 'equipment', 'type' );
		$this->addForeignKey ( 'equipment_accessory_id', 'equipment', 'accessory', 'accessory', 'id' );
		$this->addForeignKey ( 'equipment_accessory_type_id', 'equipment', 'type', 'accessory', 'id' );
	}
	public function down() {
		echo "m160726_225424_equipment_tables_data cannot be reverted.\n";
		return false;
	}
}
