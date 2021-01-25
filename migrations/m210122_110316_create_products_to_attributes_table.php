<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_to_attributes}}`.
 */
class m210122_110316_create_products_to_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_to_attributes}}', [
            'product_id' => $this->integer(),
            'attribute_code' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_to_attributes}}');
    }
}
