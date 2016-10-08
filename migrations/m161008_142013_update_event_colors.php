<?php
use yii\db\Migration;
class m161008_142013_update_event_colors extends Migration {
	public function up() {
		$this->dropColumn ( 'event', 'color' );
		$this->addColumn ( 'event_type', 'color', $this->string ( 12 ) );
	}
	public function down() {
		echo "m161008_142013_update_event_colors cannot be reverted.\n";
		return false;
	}
}
