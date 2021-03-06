<?php

use yii\db\Migration;

/**
 * This migration is used for creating the roles and permissions of the website.
 */
class m220508_005248_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Return the auth manager interface
        $auth = Yii::$app->authManager;

        /**
         * ========================
         * BEGIN: BUYER PERMISSIONS
         * ========================
         */
        $buyer= $auth->createRole("buyer");
        $auth->add($buyer);

        /**
         * BEGIN: PAYMENT METHOD
         */
        $paymentMethodRule = new \app\rbac\OwnPaymentMethodRule();
        $auth->add($paymentMethodRule);

        $addPaymentMethod= $auth->createPermission("addPaymentMethod");
        $addPaymentMethod->description = "Add a new payment method";
        $auth->add($addPaymentMethod);

        $viewPaymentMethod= $auth->createPermission("viewPaymentMethod");
        $viewPaymentMethod->description = "View the user's payment method";
        $viewPaymentMethod->ruleName = $paymentMethodRule->name;
        $auth->add($viewPaymentMethod);

        $editPaymentMethod= $auth->createPermission("editPaymentMethod");
        $editPaymentMethod->description = "Edit the user's payment method";
        $editPaymentMethod->ruleName = $paymentMethodRule->name;
        $auth->add($editPaymentMethod);

        $removePaymentMethod= $auth->createPermission("removePaymentMethod");
        $removePaymentMethod->description = "Remove the user's payment method";
        $removePaymentMethod->ruleName = $paymentMethodRule->name;
        $auth->add($removePaymentMethod);

        $viewOrderHistory = $auth->createPermission("viewOrderHistory");
        $viewOrderHistory->description = "View own order history";
        $auth->add($viewOrderHistory);

        $auth->addChild($buyer, $addPaymentMethod);
        $auth->addChild($buyer, $viewPaymentMethod);
        $auth->addChild($buyer, $editPaymentMethod);
        $auth->addChild($buyer, $removePaymentMethod);
        $auth->addChild($buyer, $viewOrderHistory);
        /**
         * END: PAYMENT METHOD
         */

        /**
         * BEGIN: NOTIFICATIONS
         */
        $notificationRule = new \app\rbac\OwnNotificationRule();
        $auth->add($notificationRule);

        $viewNotification = $auth->createPermission("viewNotification");
        $viewNotification->description = "View the user's notifications";
        $viewNotification->ruleName = $notificationRule->name;
        $auth->add($viewNotification);

        $auth->addChild($buyer, $viewNotification);
        /**
         * END: NOTIFICATIONS
         */

        /**
         * ========================
         * END: BUYER PERMISSIONS
         * ========================
         */


        /**
         * ========================
         * BEGIN: VENDOR PERMISSIONS
         * ========================
         */
        $vendor = $auth->createRole("vendor");
        $auth->add($vendor);
        $auth->addChild($vendor, $buyer);

        /**
         * BEGIN: SALES HISTORY
         */
        $viewSalesHistory = $auth->createPermission("viewSalesHistory");
        $viewSalesHistory->description = "View the sales history";
        $auth->add($viewSalesHistory);

        $auth->addChild($vendor, $viewSalesHistory);
        /**
         * END: SALES HISTORY
         */

        /**
         * BEGIN: PRODUCTS
         */

        $productRule = new \app\rbac\OwnProductRule();
        $auth->add($productRule);

        $viewProduct = $auth->createPermission("viewProduct");
        $viewProduct->description = "View the detail of a product";
        $viewProduct->ruleName = $productRule->name;
        $auth->add($viewProduct);

        $addProduct = $auth->createPermission("addProduct");
        $addProduct->description = "Add a new product";
        $auth->add($addProduct);

        $editProduct = $auth->createPermission("editProduct");
        $editProduct->description = "Edit the data of a product";
        $editProduct->ruleName = $productRule->name;
        $auth->add($editProduct);

        $removeProduct = $auth->createPermission("removeProduct");
        $removeProduct->description = "Remove a  product";
        $removeProduct->ruleName = $productRule->name;
        $auth->add($removeProduct);

        $auth->addChild($vendor, $viewProduct);
        $auth->addChild($vendor, $addProduct);
        $auth->addChild($vendor, $editProduct);
        $auth->addChild($vendor, $removeProduct);
        /**
         * END: PRODUCTS
         */

        /**
         * BEGIN: AVAILABLE PRODUCTS
         */
        $availableProductRule = new \app\rbac\OwnAvailableProductRule();
        $auth->add($availableProductRule);

        $viewAvailableProduct = $auth->createPermission("viewAvailableProduct");
        $viewAvailableProduct->description = "View an available product";
        $viewAvailableProduct->ruleName = $availableProductRule->name;
        $auth->add($viewAvailableProduct);

        $addAvailableProduct = $auth->createPermission("addAvailableProduct");
        $addAvailableProduct->description = "Set a product as available";
        $addAvailableProduct->ruleName = $productRule->name;
        $auth->add($addAvailableProduct);

        $editAvailableProduct = $auth->createPermission("editAvailableProduct");
        $editAvailableProduct->description = "Edit an available product data";
        $editAvailableProduct->ruleName = $availableProductRule->name;
        $auth->add($editAvailableProduct);

        $removeAvailableProduct = $auth->createPermission("removeAvailableProduct");
        $removeAvailableProduct->description = "Remove an available product";
        $removeAvailableProduct->ruleName = $availableProductRule->name;
        $auth->add($removeAvailableProduct);

        $auth->addChild($vendor, $viewAvailableProduct);
        $auth->addChild($vendor, $addAvailableProduct);
        $auth->addChild($vendor, $editAvailableProduct);
        $auth->addChild($vendor, $removeAvailableProduct);
        /**
         * END: AVAILABLE PRODUCTS
         */

        /**
         * ========================
         * END: VENDOR PERMISSIONS
         * ========================
         */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove all the rbac items in the system
        Yii::$app->authManager->removeAll();
    }
}
