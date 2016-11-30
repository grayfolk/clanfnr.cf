<?php
use yii\db\Migration;
class m161129_212427_fix_equipment_fk extends Migration {
	public function up() {
		$this->dropForeignKey ( 'equipment_accessory_type_id', 'equipment' );
		$this->addForeignKey ( 'equipment_accessory_type_id', 'equipment', 'type_id', 'accessory_type', 'id' );
	}
	public function down() {
		echo "m161129_212427_fix_equipment_fk cannot be reverted.\n";
		return false;
	}
}
