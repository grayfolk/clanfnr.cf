<?php
use yii\db\Migration;
class m160902_161051_material_type_table extends Migration {
	public function up() {
		$this->createTable ( 'material_type', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
	}
	public function down() {
		$this->dropTable ( 'material_type' );
	}
}
