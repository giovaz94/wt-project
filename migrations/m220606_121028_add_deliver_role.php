<?php

use yii\db\Migration;

/**
 * Class m220606_121028_add_deliver_role
 */
class m220606_121028_add_deliver_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        /**
         * ========================
         * BEGIN: DELIVER PERMISSIONS
         * ========================
         */

        $deliver= $auth->createRole("deliver");
        $auth->add($deliver);
        $auth->addChild($deliver, $auth->getRole("buyer"));

        /**
         * ========================
         * END: DELIVER PERMISSIONS
         * ========================
         */

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * ========================
         * BEGIN: DELIVER RIMOTION
         * ========================
         */

        $auth = Yii::$app->authManager;
        $auth->remove($auth->getRole("deliver"));

        /**
         * ========================
         * END: DELIVER RIMOTION
         * ========================
         */
    }
}
