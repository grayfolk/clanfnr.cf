<?php
use yii\db\Migration;
class m161008_124823_add_event_colors extends Migration {
	public function up() {
		$this->addColumn ( 'event', 'color', $this->string ( 12 ) );
		$this->addColumn ( 'location', 'color', $this->string ( 12 ) );
	}
	public function down() {
		echo "m161008_124823_add_event_colors cannot be reverted.\n";
		return false;
	}
}
