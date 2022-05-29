<?php

namespace app\rbac;

use app\models\UserNotification;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if paymentMethodId matches user passed via params
 */
class OwnNotificationRule extends Rule
{
    public $name = 'isOwnerOfNotification';

    /**
     * Return true if the notification receiver is the logged user
     *
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $paymentMethod = UserNotification::findOne([
            [
                'refUser' => Yii::$app->user->id,
                'refNotification' => $params["notificationId"]
            ]
        ]);

        return $paymentMethod !== null;
    }
}