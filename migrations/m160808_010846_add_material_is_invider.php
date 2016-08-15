<?php
use yii\db\Migration;
class m160808_010846_add_material_is_invider extends Migration {
	public function up() {
		$this->addColumn ( 'material', 'is_invider', $this->boolean ()->defaultValue ( 0 ) );
	}
	public function down() {
		echo "m160808_010846_add_material_is_invider cannot be reverted.\n";
		return false;
	}
}
