<?php
use yii\db\Migration;
class m161007_031615_update_events extends Migration {
	public function up() {
		$this->dropForeignKey ( 'event_type_id', 'event' );
		$this->dropPrimaryKey ( '', 'event' );
		$this->addPrimaryKey ( '', 'event', [ 
				'type_id',
				'start',
				'coverage' 
		] );
		$this->addForeignKey ( 'event_type_id', 'event', 'type_id', 'event_type', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m161007_031615_update_events cannot be reverted.\n";
		return false;
	}
}
