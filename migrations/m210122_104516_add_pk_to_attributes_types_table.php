<?php

use yii\db\Migration;

/**
 * Class m210122_104516_add_pk_to_attributes_types_table
 */
class m210122_104516_add_pk_to_attributes_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addPrimaryKey(
            'pk-attributes_types-code',
            'attributes_types',
            'code',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('pk-attributes_types-code', 'attributes_types');
    }
}
