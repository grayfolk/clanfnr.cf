<?php
use yii\db\Migration;
class m160726_235723_levels_and_inviders_tables extends Migration {
	public function up() {
		$this->createTable ( 'level', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
		$this->createTable ( 'invider', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 ) 
		] );
	}
	public function down() {
		echo "m160726_235723_levels_and_inviders_tables cannot be reverted.\n";
		return false;
	}
}
