<?php

use yii\db\Migration;

/**
 * Class m180421_110144_create_table_nestedsets
 */
class m180421_110144_create_table_nestedsets extends Migration
{
    
    private $tableName = 'nestedsets';
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180421_110144_create_table_nestedsets cannot be reverted.\n";

        return false;
    }
    */
}
