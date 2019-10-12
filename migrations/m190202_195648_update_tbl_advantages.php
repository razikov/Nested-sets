<?php

use yii\db\Migration;

class m190202_195648_update_tbl_advantages extends Migration
{
    public function safeUp()
    {
        $this->renameColumn('advantages', 'meta_type', 'categories');
        $this->renameColumn('advantages', 'description', 'description_rus');
        $this->alterColumn('advantages', 'categories', $this->string());
        $this->addColumn('advantages', 'round_down', $this->boolean());
        $this->addColumn('advantages', 'cr', $this->string());
        $this->addColumn('advantages', 'crAdj', $this->string());
        $this->addColumn('advantages', 'levels', $this->integer());
        $this->addColumn('advantages', 'points_per_level', $this->integer());
        $this->addColumn('advantages', 'base_points', $this->integer());
        $this->addColumn('advantages', 'reference', $this->string());
        $this->addColumn('advantages', 'notes', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('advantages', 'notes');
        $this->dropColumn('advantages', 'reference');
        $this->dropColumn('advantages', 'base_points');
        $this->dropColumn('advantages', 'points_per_level');
        $this->dropColumn('advantages', 'levels');
        $this->dropColumn('advantages', 'crAdj');
        $this->dropColumn('advantages', 'cr');
        $this->dropColumn('advantages', 'round_down');
        $this->alterColumn('advantages', 'categories', $this->integer());
        $this->renameColumn('advantages', 'description_rus', 'description');
        $this->renameColumn('advantages', 'categories', 'meta_type');
    }
}
