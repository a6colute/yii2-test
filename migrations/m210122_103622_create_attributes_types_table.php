<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attributes_types}}`.
 */
class m210122_103622_create_attributes_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attributes_types}}', [
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attributes_types}}');
    }
}
