<?php
use yii\db\Migration;
class m160727_030448_update_invoders_table_add_relations extends Migration {
	public function up() {
		$this->renameTable ( 'invider', 'location' );
		$this->addColumn ( 'location', 'type', $this->integer () );
		$this->createTable ( 'location_type', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
		$this->createIndex ( 'location_type', 'location', 'type' );
		$this->addForeignKey ( 'location_type_id', 'location', 'type', 'location_type', 'id' );
	}
	public function down() {
		echo "m160727_030448_update_invoders_table_add_relations cannot be reverted.\n";
		return false;
	}
}
