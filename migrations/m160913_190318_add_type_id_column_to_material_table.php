<?php

use yii\db\Migration;

/**
 * Handles adding type_id to table `material`.
 */
class m160913_190318_add_type_id_column_to_material_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('material', 'type_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('material', 'type_id');
    }
}
