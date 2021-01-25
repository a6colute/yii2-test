<?php

use yii\db\Migration;

/**
 * Class m210122_105057_add_pk_to_attributes_table
 */
class m210122_105057_add_pk_to_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addPrimaryKey(
            'pk-attributes-code',
            'attributes',
            'code',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('pk-attributes-code', 'attributes');
    }
}
