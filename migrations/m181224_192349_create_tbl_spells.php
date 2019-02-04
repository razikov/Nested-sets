<?php

use yii\db\Migration;

class m181224_192349_create_tbl_spells extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('spells', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'name_rus' => $this->string(),
            'descryption' => $this->text(),
            'class' => $this->string(),
            'type' => $this->string(),
            'duration' => $this->text(),
            'cost' => $this->text(),
            'time_of_creation' => $this->text(),
            'requirement' => $this->text(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('spells');
    }
    
}
