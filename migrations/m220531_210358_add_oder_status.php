<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220531_210358_add_oder_status
 */
class m220531_210358_add_oder_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("order", "status", Schema::TYPE_INTEGER);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropColumn("order", "status");
    }
}
