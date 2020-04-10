<?php

namespace app\modules\historyChange\migrations;

use yii\db\Migration;

class m180711_153403_create_tables_history_change extends Migration
{
    const TABLE_NAME = 'history_change';
    
    public function safeUp()
    {
        $this->createTable(
            self::TABLE_NAME,
            [
                'id' => $this->primaryKey(),
                'model_name' => $this->string()->notNull(),
                'model_id' => $this->integer()->notNull(),
                'attribute' => $this->string()->notNull(),
                'old_value' => $this->text(),
                'new_value' => $this->text(),
                'action' => $this->string(),
                'change_at' => $this->datetime()->notNull(),
                'change_by' => $this->integer()->notNull(),
            ]
        );
        
        $this->createIndex("idx_history_change_model_name", 'history_change', 'model_name');
        $this->createIndex("idx_history_change_model_id", "history_change", 'model_id');
        $this->createIndex("idx_history_change_attribute", "history_change", 'attribute');
        $this->createIndex("idx_history_change_change_by", "history_change", 'change_by');
        $this->createIndex("idx_history_change_action", "history_change", 'action');
    }

    public function safeDown()
    {
        if ($this->hasProperty("idx_history_change_model_name")) {
            $this->dropIndex("idx_history_change_model_name", "history_change");
        }
        if ($this->hasProperty("idx_history_change_model_id")) {
            $this->dropIndex("idx_history_change_model_id", "history_change");
        }
        if ($this->hasProperty("idx_history_change_attribute")) {
            $this->dropIndex("idx_history_change_attribute", "history_change");
        }
        if ($this->hasProperty("idx_history_change_change_by")) {
            $this->dropIndex("idx_history_change_change_by", "history_change");
        }
        if ($this->hasProperty("idx_history_change_action")) {
            $this->dropIndex("idx_history_change_action", "history_change");
        }
        $this->dropTable("history_change");
    }
}
