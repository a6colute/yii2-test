<?php

use yii\db\Migration;

/**
 * Class m210122_111535_add_fk_to_products_to_attributes_table
 */
class m210122_111535_add_fk_to_products_to_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-products_to_attributes-product_id',
            'products_to_attributes',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products_to_attributes-product_id', 'products_to_attributes');
    }
}
