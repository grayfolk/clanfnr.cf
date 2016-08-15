<?php
use yii\db\Migration;
class m160805_220025_material_add_type_add_expiriences_table extends Migration {
	public function up() {
		$this->addColumn ( 'material', 'is_stone', $this->boolean ()->defaultValue ( 0 ) );
		$this->createTable ( 'material_expirience', [ 
				'material_id' => $this->integer ( 11 )->notNull (),
				'expirience_id' => $this->integer ( 11 )->notNull (),
				'level_id' => $this->integer ( 11 )->notNull (),
				'quantity' => $this->double ( 1 ) 
		] );
		$this->addPrimaryKey ( '', 'material_expirience', [ 
				'material_id',
				'expirience_id',
				'level_id' 
		] );
		$this->addForeignKey ( 'material_expirience_material_id', 'material_expirience', 'material_id', 'material', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'material_expirience_expirience_id', 'material_expirience', 'expirience_id', 'expirience', 'id', 'CASCADE', 'CASCADE' );
		$this->addForeignKey ( 'material_expirience_level_id', 'material_expirience', 'level_id', 'level', 'id', 'CASCADE', 'CASCADE' );
	}
	public function down() {
		echo "m160805_220025_material_add_type_add_expiriences_table cannot be reverted.\n";
		return false;
	}
}
