<?php

use yii\db\Migration;

class m181229_193743_create_table_modifiers extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('modifiers', [
            'id' => $this->primaryKey(),
            'record_type' => $this->integer(),
            'record_id' => $this->integer(),
            'value' => $this->integer(),
            'has_per_level' => $this->boolean(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('modifiers');
    }
}
