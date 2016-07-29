<?php
use yii\db\Migration;
class m160727_032214_fix_location_table_type_to_type_id extends Migration {
	public function up() {
		$this->dropForeignKey ( 'location_type_id', 'location' );
		$this->dropIndex ( 'location_type', 'location' );
		$this->renameColumn ( 'location', 'type', 'type_id' );
		$this->createIndex ( 'location_type_id', 'location', 'type_id' );
		$this->addForeignKey ( 'location_type_id', 'location', 'type_id', 'location_type', 'id' );
	}
	public function down() {
		echo "m160727_032214_fix_location_table_type_to_type_id cannot be reverted.\n";
		return false;
	}
}
