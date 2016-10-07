<?php
use yii\db\Migration;
class m161007_021343_add_events_type extends Migration {
	public function up() {
		$this->addColumn ( 'event_type', 'type', $this->string ( 255 ) );
	}
	public function down() {
		echo "m161007_021343_add_events_type cannot be reverted.\n";
		return false;
	}
}
