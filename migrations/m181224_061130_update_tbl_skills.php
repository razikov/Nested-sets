<?php

use yii\db\Migration;

/**
 * Class m181224_061130_update_tbl_skills
 */
class m181224_061130_update_tbl_skills extends Migration
{
    public function safeUp()
    {
        $this->addColumn('skills', 'meta_type', $this->integer()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('skills', 'meta_type');
    }
}
