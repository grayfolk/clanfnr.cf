<?php
use yii\db\Migration;
class m161228_232806_update_events_pk extends Migration {
	public function up() {
		$this->dropForeignKey ( 'event_type_id', 'event' );
		$this->dropPrimaryKey ( '', 'event' );
		$this->addPrimaryKey ( '', 'event', [ 
				'type_id',
				'start',
				'coverage',
				'invider_id' 
		] );
		$this->addForeignKey ( 'event_type_id', 'event', 'type_id', 'event_type', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m161228_232806_update_events_pk cannot be reverted.\n";
		return false;
	}
}
