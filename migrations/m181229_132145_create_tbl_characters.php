<?php

use yii\db\Migration;

class m181229_132145_create_tbl_characters extends Migration
{
    
    public function safeUp()
    {
        $this->createTable('characters', [
            'id' => $this->primaryKey(),
            'avatar_img' => $this->integer(),
            'character_name' => $this->string(),
            'player_name' => $this->string(),
            'height' => $this->string(),
            'weight' => $this->string(),
            'age' => $this->string(),
            'sex' => $this->integer(),
            'appearance' => $this->text(),
            'biography' => $this->text(),
            'size_modifier' => $this->string(),
            'tech_level' => $this->string(),
            'acc_strength' => $this->integer(),
            'acc_dexterity' => $this->integer(),
            'acc_intelegence' => $this->integer(),
            'acc_health' => $this->integer(),
            'acc_hit_points' => $this->integer(),
            'acc_will' => $this->integer(),
            'acc_perception' => $this->integer(),
            'acc_fatigue_points' => $this->integer(),
            'acc_base_speed' => $this->integer(),
            'acc_base_move' => $this->integer(),
            'current_hit_points' => $this->integer(),
            'current_fatigue_points' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('characters');
    }
}
