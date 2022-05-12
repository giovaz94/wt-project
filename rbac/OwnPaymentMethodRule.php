<?php

namespace app\rbac;

use app\models\PaymentMethod;
use Yii;
use yii\rbac\Rule;

/**
 * Checks if paymentMethodId matches user passed via params
 */
class OwnPaymentMethodRule extends Rule
{
    public $name = 'isOwnerOfPaymentMethod';

    /**
     * Return true if the id is the same of the one passed via params
     *
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $paymentMethod = PaymentMethod::findOne($params['paymentMethodId']);

        if($paymentMethod) {
            return Yii::$app->user->id == $paymentMethod->refUser;
        }

        return false;
    }
}