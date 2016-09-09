<?php

use yii\db\Migration;

class m160902_161051_material_type_table extends Migration
{
    public function up()
    {
		$this->createTable('material_type', [
			
			'id' => $this->integer( 11 )->notNull()->primaryKey(),
			'title' => $this->varchar( 255 ),
			'is_stone' =>$this->tinyint( 1 ),
			'is_invider' => $this->tinyint( 1 ), 
			 
			 ]);
			
    }

    public function down()
    {
        
        $this->dropTable('material_type');
        
        echo "m160902_161051_material_type_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
