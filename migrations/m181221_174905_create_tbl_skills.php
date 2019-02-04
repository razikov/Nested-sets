<?php

use yii\db\Migration;

class m181221_174905_create_tbl_skills extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('skills', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'name_rus' => $this->string(),
            'type' => $this->string(),
            'default' => $this->text(),
            'requirement' => $this->text(),
            'description' => $this->text(),
            'modifier' => $this->text(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('skills');
    }
    
}
