<?php

use yii\db\Migration;

/**
 * Class m181210_200052_create_tbl_advantages
 */
class m181210_200052_create_tbl_advantages extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('advantages', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'name_rus' => $this->string(),
            'description' => $this->text(),
            'type' => $this->string(),
            'cost' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('advantages');
    }
    
}
