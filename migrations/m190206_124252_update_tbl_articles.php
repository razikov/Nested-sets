<?php

use yii\db\Migration;

class m190206_124252_update_tbl_articles extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('articles', 'title', $this->string()->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('articles', 'title', $this->char()->notNull());
    }
}
