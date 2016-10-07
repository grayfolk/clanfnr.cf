<?php
use yii\db\Migration;
class m161007_013340_add_events extends Migration {
	public function up() {
		$this->createTable ( 'event', [ 
				'type_id' => $this->integer ()->notNull (),
				'start' => $this->date ()->notNull (),
				'end' => $this->date (),
				'type' => $this->string ( 32 ),
				'quantity' => $this->smallInteger () 
		] );
		$this->createTable ( 'event_type', [ 
				'id' => $this->primaryKey (),
				'title' => $this->string ( 255 )->notNull ()->unique () 
		] );
		$this->addPrimaryKey ( '', 'event', [ 
				'type_id',
				'start' 
		] );
		$this->addForeignKey ( 'event_type_id', 'event', 'type_id', 'event_type', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m161007_013340_add_events cannot be reverted.\n";
		return false;
	}
}
