<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220531_221243_add_reset_key
 */
class m220531_221243_add_reset_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("User" , "resetKey", Schema::TYPE_STRING);
        $this->alterColumn("User", "resetKey", $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("User", "resetKey");
    }
}
