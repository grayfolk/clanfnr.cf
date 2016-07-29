<?php
use yii\db\Migration;
class m160729_203519_remove_ee_table extends Migration {
	public function up() {
		$this->dropForeignKey ( 'expirience_equipment_equipment_id', 'expirience_equipment' );
		$this->dropForeignKey ( 'expirience_equipment_expirience_id', 'expirience_equipment' );
		$this->dropTable ( 'expirience_equipment' );
	}
	public function down() {
		echo "m160729_203519_remove_ee_table cannot be reverted.\n";
		return false;
	}
}
