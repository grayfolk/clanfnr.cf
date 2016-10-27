<?php

use yii\db\Migration;

class m161026_170823_add_autoincrement extends Migration
{
    public function up()
    {
		$this->alterColumn('troops', 'id', $this->integer(11).' NOT NULL AUTO_INCREMENT');
		
		$this->alterColumn('troops_type', 'id', $this->integer(11).' NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        echo "m161026_170823_add_autoincrement cannot be reverted.\n";

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
