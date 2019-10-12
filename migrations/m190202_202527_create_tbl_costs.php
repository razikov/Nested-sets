<?php

use yii\db\Migration;

class m190202_202527_create_tbl_costs extends Migration
{
    public function safeUp()
    {
        $this->createTable('costs', [
            'id' => $this->primaryKey(),
            'value' => $this->string(),
            'type' => $this->string(),
            'per_level' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('costs');
    }
}
