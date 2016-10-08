<?php
use yii\db\Migration;
class m161008_114151_add_invider_to_events extends Migration {
	public function up() {
		$this->addColumn ( 'event', 'invider_id', $this->integer () );
	}
	public function down() {
		echo "m161008_114151_add_invider_to_events cannot be reverted.\n";
		return false;
	}
}
