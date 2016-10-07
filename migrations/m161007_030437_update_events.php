<?php
use yii\db\Migration;
class m161007_030437_update_events extends Migration {
	public function up() {
		$this->renameColumn ( 'event', 'type', 'coverage' );
	}
	public function down() {
		echo "m161007_030437_update_events cannot be reverted.\n";
		return false;
	}
}
