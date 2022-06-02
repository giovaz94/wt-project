<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220602_144758_add_year_of_pubblication
 */
class m220602_144758_add_year_of_publication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("Product", "publication", Schema::TYPE_DATE);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("Product", "publication");
    }
}
