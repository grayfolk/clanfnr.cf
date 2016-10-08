<?php
use yii\db\Migration;
class m161008_113130_update_events extends Migration {
	public function up() {
		$this->dropColumn ( 'event_type', 'type' );
	}
	public function down() {
		echo "m161008_113130_update_events cannot be reverted.\n";
		return false;
	}
}
