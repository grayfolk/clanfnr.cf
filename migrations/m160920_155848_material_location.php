<?php

use yii\db\Migration;

class m160920_155848_material_location extends Migration
{
    public function up()
    {
		$this->createTable ( 'material_location', [ 
				'material_id' => $this->integer ( 11 ),
				'location_id' => $this->integer ( 11 )
		] );
		
		$this->addPrimaryKey ( '', 'material_location', [ 
				'material_id',
				'location_id' 
		] );
    }

    public function down()
    {
        echo "m160920_155848_material_location cannot be reverted.\n";

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
