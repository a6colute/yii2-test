<?php

use yii\db\Migration;

/**
 * Class m210122_105415_add_fk_to_attributes_table
 */
class m210122_105415_add_fk_to_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-attributes-type_code',
            'attributes',
            'type_code',
            'attributes_types',
            'code',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-attributes-type_code', 'attributes');
    }
}
