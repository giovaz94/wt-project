<?php

namespace app\rbac;

use app\models\PaymentMethod;
use app\models\Product;
use Yii;
use yii\rbac\Rule;

/**
 * Checks if paymentMethodId matches user passed via params
 */
class OwnProductRule extends Rule
{
    public $name = 'isOwnerOfProduct';

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
        $product = Product::findOne($params['productId']);

        if($product) {
            return Yii::$app->user->id == $product->refUser;
        }

        return false;
    }
}