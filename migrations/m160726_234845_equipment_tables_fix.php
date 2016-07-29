<?php
use yii\db\Migration;
class m160726_234845_equipment_tables_fix extends Migration {
	public function up() {
		$this->dropForeignKey ( 'equipment_accessory_id', 'equipment' );
		$this->dropForeignKey ( 'equipment_accessory_type_id', 'equipment' );
		$this->renameColumn ( 'equipment', 'accessory', 'accessory_id' );
		$this->renameColumn ( 'equipment', 'type', 'type_id' );
		$this->createIndex ( 'accessory_id', 'equipment', 'accessory_id' );
		$this->createIndex ( 'type_id', 'equipment', 'type_id' );
		$this->addForeignKey ( 'equipment_accessory_id', 'equipment', 'accessory_id', 'accessory', 'id' );
		$this->addForeignKey ( 'equipment_accessory_type_id', 'equipment', 'type_id', 'accessory', 'id' );
	}
	public function down() {
		echo "m160726_234845_equipment_tables_fix cannot be reverted.\n";
		return false;
	}
}
