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
                'user_id' => $this->integer()->notNull(),
            ]
        );
        
        $this->createIndex("idx_".self::TABLE_NAME.'model_name', self::TABLE_NAME, 'model_name');
        $this->createIndex("idx_".self::TABLE_NAME.'model_id', self::TABLE_NAME, 'model_id');
        $this->createIndex("idx_".self::TABLE_NAME.'attribute', self::TABLE_NAME, 'attribute');
        $this->createIndex("idx_".self::TABLE_NAME.'user_id', self::TABLE_NAME, 'user_id');
        $this->createIndex("idx_".self::TABLE_NAME.'action', self::TABLE_NAME, 'action');
    }

    public function safeDown()
    {
        if ($this->hasProperty("idx_".self::TABLE_NAME.'model_name')) {
            $this->dropIndex("idx_".self::TABLE_NAME.'model_name', self::TABLE_NAME);
        }
        if ($this->hasProperty("idx_".self::TABLE_NAME.'model_id')) {
            $this->dropIndex("idx_".self::TABLE_NAME.'model_id', self::TABLE_NAME);
        }
        if ($this->hasProperty("idx_".self::TABLE_NAME.'attribute')) {
            $this->dropIndex("idx_".self::TABLE_NAME.'attribute', self::TABLE_NAME);
        }
        if ($this->hasProperty("idx_".self::TABLE_NAME.'user_id')) {
            $this->dropIndex("idx_".self::TABLE_NAME.'user_id', self::TABLE_NAME);
        }
        if ($this->hasProperty("idx_".self::TABLE_NAME.'action')) {
            $this->dropIndex("idx_".self::TABLE_NAME.'action', self::TABLE_NAME);
        }
        $this->dropTable(self::TABLE_NAME);
    }
}