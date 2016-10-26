<?php

use yii\db\Migration;

class m161026_114401_troops extends Migration
{
    public function up()
    {
		$this->createTable ('troops', [ 
			'id' => $this->integer(11),
			'title' => $this->string(255)->unique(),
			'type_id' => $this->integer(11),
			'level_id' => $this->integer(11),
			
		]);
		
		$this->addPrimaryKey ('', 'troops', [ 
				'id'
		]);
		
    }
    
    

    public function down()
    {
        echo "m161026_114401_troops cannot be reverted.\n";

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
