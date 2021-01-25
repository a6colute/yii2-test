<?php

use yii\db\Migration;

/**
 * Class m210122_112100_add_fk_to_products_to_attributes_table
 */
class m210122_112100_add_fk_to_products_to_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-products_to_attributes-attribute_code',
            'products_to_attributes',
            'attribute_code',
            'attributes',
            'code',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products_to_attributes-attribute_code', 'products_to_attributes');
    }
}
