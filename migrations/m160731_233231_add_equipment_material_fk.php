<?php
use yii\db\Migration;
class m160731_233231_add_equipment_material_fk extends Migration {
	public function up() {
		$this->addForeignKey ( 'eqiupment_material_equipment_id', 'eqiupment_material', 'equipment_id', 'equipment', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'eqiupment_material_material_id', 'eqiupment_material', 'material_id', 'material', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m160731_233231_add_equipment_material_fk cannot be reverted.\n";
		return false;
	}
}
