<?php

use yii\db\Migration;

class m161026_122745_troops_type extends Migration
{
    public function up()
    {
		$this->createTable ('troops_type', [ 
			'id' => $this->integer(11),
			'title' => $this->string(255)->unique(),
			
		]);
		
		$this->addPrimaryKey ('', 'troops_type', [ 
				'id'
		]);
    }

    public function down()
    {
        echo "m161026_122745_troops_type cannot be reverted.\n";

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
