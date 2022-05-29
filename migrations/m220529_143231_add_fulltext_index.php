<?php

use yii\db\Migration;

/**
 * Class m220529_143231_add_fulltext_index
 */
class m220529_143231_add_fulltext_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE FULLTEXT INDEX ftnd ON Product(name, description) ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex("ftnd", "Product");
    }
}
