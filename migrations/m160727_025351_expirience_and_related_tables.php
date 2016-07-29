<?php
use yii\db\Migration;
class m160727_025351_expirience_and_related_tables extends Migration {
	public function up() {
		$this->createTable ( 'expirience', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
		$this->createTable ( 'expirience_equipment', [ 
				'equipment_id' => $this->integer ( 11 ),
				'expirience_id' => $this->integer ( 11 ) 
		] );
		$this->addPrimaryKey ( '', 'expirience_equipment', [ 
				'equipment_id',
				'expirience_id' 
		] );
		$this->createIndex ( 'equipment_id', 'expirience_equipment', 'equipment_id' );
		$this->createIndex ( 'expirience_id', 'expirience_equipment', 'expirience_id' );
		$this->addForeignKey ( 'expirience_equipment_equipment_id', 'expirience_equipment', 'equipment_id', 'equipment', 'id' );
		$this->addForeignKey ( 'expirience_equipment_expirience_id', 'expirience_equipment', 'expirience_id', 'expirience', 'id' );
	}
	public function down() {
		echo "m160727_025351_expirience_and_related_tables cannot be reverted.\n";
		return false;
	}
}
