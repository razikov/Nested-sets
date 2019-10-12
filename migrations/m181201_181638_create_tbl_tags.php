<?php

use yii\db\Migration;

class m181201_181638_create_tbl_tags extends Migration
{
    public function safeUp()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
            'name' => $this->char()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tags');
    }
}
