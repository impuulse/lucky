<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m190808_193153_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'cover_type_id' => $this->integer()->notNull()->comment('Тип обложки'),
            'name' => $this->string()->notNull()->comment('Название'),
            'edition' => $this->integer()->notNull()->comment('Тираж')
        ]);

        $this->createTable('{{%cover_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название')
        ]);

        $this->addForeignKey('book-cover_type_id', '{{%book}}', 'cover_type_id', '{{%cover_type}}', 'id', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('book-cover_type_id', '{{%book}}');
        $this->dropTable('{{%book}}');
        $this->dropTable('{{%cover_type}}');
    }
}
