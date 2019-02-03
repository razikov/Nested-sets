<?php

use yii\db\Migration;

class m181201_180408_create_tbl_articles extends Migration
{
    public function safeUp()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'title' => $this->char()->notNull(),
            'description' => $this->text(),
            'content' => $this->text(),
            'created_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'publish_at' => $this->dateTime(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('articles');
    }
}
