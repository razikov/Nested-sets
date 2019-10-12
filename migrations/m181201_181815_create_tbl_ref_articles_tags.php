<?php

use yii\db\Migration;

/**
 * Class m181201_181815_create_tbl_ref_articles_tags
 */
class m181201_181815_create_tbl_ref_articles_tags extends Migration
{
    public function safeUp()
    {
        $this->createTable('ref_articles_tags', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('ref_articles_tags');
    }
}
