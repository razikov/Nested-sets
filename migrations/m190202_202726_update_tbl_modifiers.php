<?php

use yii\db\Migration;

/**
 * Class m190202_202726_update_tbl_modifiers
 */
class m190202_202726_update_tbl_modifiers extends Migration
{
    public function safeUp()
    {
        $this->dropTable('modifiers');
        $this->createTable('modifiers', [
            'id' => $this->primaryKey(),
            'cost_id' => $this->integer(),
            'name' => $this->string(),
            'name_rus' => $this->string(),
            'notes' => $this->text(),
            'levels' => $this->integer(),
            'reference' => $this->string(),
            'affects' => $this->string(),
        ]);
        
    }

    public function safeDown()
    {
        return false;
    }
}
