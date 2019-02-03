<?php

use yii\db\Migration;

class m190201_192243_update_tbl_character extends Migration
{
    public function safeUp()
    {
        $this->renameColumn('characters', 'acc_strength', '_st');
        $this->renameColumn('characters', 'acc_dexterity', '_dx');
        $this->renameColumn('characters', 'acc_intelegence', '_iq');
        $this->renameColumn('characters', 'acc_health', '_ht');
        $this->renameColumn('characters', 'acc_hit_points', '_hp');
        $this->renameColumn('characters', 'acc_will', '_will');
        $this->renameColumn('characters', 'acc_perception', '_perception');
        $this->renameColumn('characters', 'acc_fatigue_points', '_fp');
        $this->renameColumn('characters', 'acc_base_speed', '_speed');
        $this->renameColumn('characters', 'acc_base_move', '_move');
    }

    public function safeDown()
    {
        $this->renameColumn('characters', '_st', 'acc_strength');
        $this->renameColumn('characters', '_dx', 'acc_dexterity');
        $this->renameColumn('characters', '_iq', 'acc_intelegence');
        $this->renameColumn('characters', '_ht', 'acc_health');
        $this->renameColumn('characters', '_hp', 'acc_hit_points');
        $this->renameColumn('characters', '_will', 'acc_will');
        $this->renameColumn('characters', '_perception', 'acc_perception');
        $this->renameColumn('characters', '_fp', 'acc_fatigue_points');
        $this->renameColumn('characters', '_speed', 'acc_base_speed');
        $this->renameColumn('characters', '_move', 'acc_base_move');
    }
}
