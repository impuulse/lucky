<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m190808_195719_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название')
        ]);

        $this->createTable('{{%book_category}}', [
            'book_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('book_id-category_id', '{{%book_category}}', ['book_id', 'category_id']);
        $this->addForeignKey('book_category-book_id', '{{%book_category}}', 'book_id', '{{%book}}', 'id', 'CASCADE');
        $this->addForeignKey('book_category-category_id', '{{%book_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('book_category-book_id', '{{%book_category}}');
        $this->dropForeignKey('book_category-category_id', '{{%book_category}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%book_category}}');
    }
}
