<?php

use yii\db\Migration;

/**
 * Class m200116_110434_create_table_rasp_reservation
 */
class m200116_110434_create_table_rasp_reservation extends Migration
{
    public function safeUp()
    {
        $this->createTable('rasp_reservation', [
            'id' => $this->primaryKey(),
            'id_themes' => $this->integer()->notNull(),
            'classroom' => $this->string()->notNull(),
            'time_start_at' => $this->string()->notNull(),
            'time_end_at' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('rasp_reservation');
    }
}
