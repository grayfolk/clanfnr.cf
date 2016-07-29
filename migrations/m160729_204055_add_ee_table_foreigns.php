<?php
use yii\db\Migration;
class m160729_204055_add_ee_table_foreigns extends Migration {
	public function up() {
		$this->dropForeignKey ( 'equipment_accessory_id', 'equipment' );
		$this->dropForeignKey ( 'equipment_accessory_type_id', 'equipment' );
		$this->dropForeignKey ( 'location_type_id', 'location' );
		$this->addForeignKey ( 'equipment_accessory_id', 'equipment', 'accessory_id', 'accessory', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'equipment_accessory_type_id', 'equipment', 'type_id', 'accessory', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'location_type_id', 'location', 'type_id', 'location_type', 'id', 'CASCADE', 'CASCADE' );
		
		$this->addForeignKey ( 'eqiupment_expirience_equipment_id', 'eqiupment_expirience', 'equipment_id', 'equipment', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'eqiupment_expirience_expirience_id', 'eqiupment_expirience', 'expirience_id', 'expirience', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'eqiupment_expirience_level_id', 'eqiupment_expirience', 'level_id', 'level', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m160729_204055_add_ee_table_foreigns cannot be reverted.\n";
		return false;
	}
}
