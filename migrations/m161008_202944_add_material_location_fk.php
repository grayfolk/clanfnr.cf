<?php
use yii\db\Migration;
class m161008_202944_add_material_location_fk extends Migration {
	public function up() {
		$this->addForeignKey ( 'material_location_material_id', 'material_location', 'material_id', 'material', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'material_location_location_id', 'material_location', 'location_id', 'location', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m161008_202944_add_material_location_fk cannot be reverted.\n";
		return false;
	}
}
