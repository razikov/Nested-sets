<?php

use yii\db\Migration;

class m181229_174658_create_tbl_reference_traits extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('ref_traits', [
            'id' => $this->primaryKey(),
            'advantage_id' => $this->integer(),
            'character_id' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('ref_traits');
    }
    
}
