<?php
use yii\db\Migration;
class m161201_195320_fix_equipment_names extends Migration {
	public function up() {
		$this->dropForeignKey ( 'eqiupment_expirience_equipment_id', 'eqiupment_expirience' );
		$this->dropForeignKey ( 'eqiupment_expirience_expirience_id', 'eqiupment_expirience' );
		$this->dropForeignKey ( 'eqiupment_expirience_level_id', 'eqiupment_expirience' );
		$this->dropForeignKey ( 'material_expirience_expirience_id', 'material_expirience' );
		$this->dropForeignKey ( 'material_expirience_level_id', 'material_expirience' );
		$this->dropForeignKey ( 'material_expirience_material_id', 'material_expirience' );
		$this->renameColumn ( 'eqiupment_expirience', 'expirience_id', 'experience_id' );
		$this->renameColumn ( 'material_expirience', 'expirience_id', 'experience_id' );
		$this->renameTable ( 'eqiupment_expirience', 'equipment_experience' );
		$this->renameTable ( 'eqiupment_material', 'equipment_material' );
		$this->renameTable ( 'expirience', 'experience' );
		$this->renameTable ( 'material_expirience', 'material_experience' );
		$this->addForeignKey ( 'eqiupment_experience_equipment_id', 'equipment_experience', 'equipment_id', 'equipment', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'eqiupment_experience_expirience_id', 'equipment_experience', 'experience_id', 'experience', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'eqiupment_experience_level_id', 'equipment_experience', 'level_id', 'level', 'id', 'CASCADE', 'CASCADE' );
		
		$this->addForeignKey ( 'material_experience_material_id', 'material_experience', 'material_id', 'material', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'material_experience_experience_id', 'material_experience', 'experience_id', 'experience', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'material_experience_level_id', 'material_experience', 'level_id', 'level', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m161201_195320_fix_equipment_names cannot be reverted.\n";
		return false;
	}
}
