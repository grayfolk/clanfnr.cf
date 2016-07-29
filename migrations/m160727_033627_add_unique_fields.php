<?php
use yii\db\Migration;
class m160727_033627_add_unique_fields extends Migration {
	public function up() {
		$this->alterColumn ( 'accessory', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'accessory_type', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'equipment', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'expirience', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'level', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'location', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'location_type', 'title', $this->string ( 255 )->unique () );
		$this->alterColumn ( 'material', 'title', $this->string ( 255 )->unique () );
	}
	public function down() {
		echo "m160727_033627_add_unique_fields cannot be reverted.\n";
		return false;
	}
}
