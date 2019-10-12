<?php

use yii\db\Migration;

class m181214_201537_update_tbl_advantages extends Migration
{
    public function safeUp()
    {
        $this->addColumn('advantages', 'meta_type', $this->integer()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('advantages', 'meta_type');
    }
}
