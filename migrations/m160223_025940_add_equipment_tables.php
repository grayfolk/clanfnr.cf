<?php
use yii\db\Migration;
use yii\db\Schema;
class m160223_025940_add_equipment_tables extends Migration {
	public function up() {
		$this->createTable ( 'equipment', [ 
				'id' => Schema::TYPE_PK,
				'title' => Schema::TYPE_STRING,
				'accessory' => Schema::TYPE_SMALLINT,
				'type' => Schema::TYPE_SMALLINT,
				'level' => Schema::TYPE_SMALLINT,
				'silver' => Schema::TYPE_INTEGER 
		] );
		$this->createTable ( 'material', [ 
				'id' => Schema::TYPE_PK,
				'title' => Schema::TYPE_STRING 
		] );
	}
	public function down() {
		$this->dropTable ( 'equipment' );
		$this->dropTable ( 'material' );
	}
}
