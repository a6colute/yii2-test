<?php

use yii\db\Migration;

/**
 * Class m210122_111031_add_pk_to_products_to_attributes_table
 */
class m210122_111031_add_pk_to_products_to_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addPrimaryKey(
            'pk-products_to_attributes-attribute_code-product_id',
            'products_to_attributes',
            ['product_id', 'attribute_code'],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('pk-products_to_attributes-attribute_code-product_id', 'products_to_attributes');
    }
}
