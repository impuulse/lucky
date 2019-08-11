<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m190809_074406_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'datetime' => $this->dateTime()->notNull()->comment('Время'),
            'status' => 'ENUM("1","2")'
        ]);

        $this->batchInsert('{{%log}}', ['id', 'datetime', 'status'], [
            [1, '2019-08-09 09:15:11', 1],
            [2, '2019-08-09 09:20:03', 2],
            [3, '2019-08-09 09:15:11', 1],
            [4, '2019-08-09 10:46:05', 2],
            [5, '2019-08-10 10:45:45', 1],
            [6, '2019-08-10 10:50:06', 2],
            [7, '2019-08-09 12:25:21', 1],
            [8, '2019-08-09 12:25:45', 2],
            [9, '2019-08-10 10:45:45', 1],
            [10, '2019-08-10 14:28:35', 2],
            [11, '2019-08-09 09:15:11', 1],
            [12, '2019-08-09 09:40:03', 2],
        ]);

        $this->createIndex('datetime_status', 'log', ['datetime', 'status']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
