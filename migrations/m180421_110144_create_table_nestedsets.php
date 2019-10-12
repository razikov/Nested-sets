<?php

use yii\db\Migration;

class m180421_110144_create_table_nestedsets extends Migration
{
    
    private $tableName = 'nestedsets';
    
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->char(50)->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'lvl' => $this->integer(4)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
