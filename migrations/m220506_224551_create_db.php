<?php

use yii\db\Schema;
use yii\db\Migration;


/**
 * This class will define the database for the project.
 * Transactions should be supported and enabled in the DB engine.
 */
class m220506_224551_create_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * TABLE DEFINITIONS
         */
        // User table
        $this->createTable("User", [
            "idUser" => $this->primaryKey(),
            "firstName" => $this->string()->notNull(),
            "lastName" => $this->string()->notNull(),
            "email" => $this->string()->notNull()->unique(),
            "username" => $this->string()->notNull()->unique(),
            "password" => $this->string()->notNull(),
            "dateOfBirth" => $this->date(),
            "cityOfBirth" => $this->string(),
            "refTaxData" => $this->integer()
        ]);

        // TaxData table
        $this->createTable("TaxData", [
            "idTaxData" => $this->primaryKey(),
            "businessName" => $this->string()->notNull(),
            "vatNumber" => $this->string()->notNull(),
            "businessAddress" => $this->string()->notNull(),
            "businessCity" => $this->string()->notNull()
        ]);

        // PaymentMethod table
        $this->createTable("PaymentMethod", [
            "idPaymentMethod" => $this->primaryKey(),
            "creditCardNumber" => $this->integer(16)->notNull(),
            "creditCardSecurity" => $this->integer(3)->notNull(),
            "expiringDate" => $this->date()->notNull(),
            "ownerFirstName" => $this->string()->notNull(),
            "ownerLastName" => $this->string()->notNull(),
            "refUser" => $this->integer()->notNull()
        ]);

        // Notification table
        $this->createTable("Notification", [
            "idNotification" => $this->primaryKey(),
            "title" => $this->string()->notNull(),
            "body" => $this->text()->notNull(),
            "dateOfCreation" => $this->dateTime()->notNull(),
        ]);

        // UserNotification table
        $this->createTable('UserNotification', [
            'refUser' => $this->integer(),
            'refNotification' => $this->integer(),
            'readDate' => $this->dateTime(),
            'PRIMARY KEY(refUser, refNotification)',
        ]);

        // ProductTypology table
        $this->createTable("ProductTypology", [
            "idProductTypology" => $this->primaryKey(),
            "name" => $this->string()->notNull(),
            "description" => $this->text()
        ]);

        // ProductCategory table
        $this->createTable("ProductCategory", [
            "idProductCategory" => $this->primaryKey(),
            "name" => $this->string()->notNull(),
            "description" => $this->text()
        ]);

        // Product table
        $this->createTable("Product", [
            "idProduct" => $this->primaryKey(),
            "name" => $this->string()->notNull(),
            "description" => $this->text()->notNull(),
            "img" => $this->string()->notNull(),
            "price" => $this->float()->notNull(),
            "totalPages" => $this->smallInteger()->notNull(),
            "releaseDate" => $this->date()->notNull(),
            "author" => $this->string()->notNull(),
            "refProductCategory" => $this->integer(),
            "refProductTypology" => $this->integer(),
            "refUser" => $this->integer()
        ]);

        //AvailableProduct table
        $this->createTable("AvailableProduct", [
            "idAvailableProduct" => $this->primaryKey(),
            "availability" => $this->integer()->notNull(),
            "sellingPrice" => $this->float()->notNull(),
            "refProduct" => $this->integer()
        ]);

        // Cart table
        $this->createTable("Cart", [
            "idCart" => $this->primaryKey(),
            "total" => $this->float()->notNull()->defaultValue(0.0),
            "refUser" => $this->integer()->notNull(),
        ]);

        // CartItem table
        $this->createTable("CartItem", [
            "idCartItem" => $this->primaryKey(),
            "quantity" => $this->integer()->notNull(),
            "subtotal" => $this->float()->notNull(),
            "refCart" => $this->integer(),
            "refAvailableProduct" => $this->integer()
        ]);

        // Order table
        $this->createTable("Order", [
            "idOrder" => $this->primaryKey(),
            "dateOfCreation" => $this->dateTime()->notNull(),
            "total" => $this->float()->notNull(),
            "refUser" => $this->integer(),
        ]);

        // OrderLine table
        $this->createTable("OrderItem", [
            "idOrderLine" => $this->primaryKey(),
            "name" => $this->string()->notNull(),
            "img" => $this->string()->notNull(),
            "description" => $this->text()->notNull(),
            "unitPrice" => $this->float()->notNull(),
            "quantity" => $this->integer()->notNull(),
            "subtotal" => $this->float()->notNull(),
            "refOrder" => $this->integer(),
        ]);

        /**
         * USER TABLE FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-user-refTaxData',
            'user',
            'refTaxData'
        );

        $this->addForeignKey(
            'fk-user-refTaxData',
            'User',
            'refTaxData',
            'TaxData',
            'idTaxData',
            'NO ACTION'
        );

        /**
         * PAYMENT METHOD FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-paymentMethod-refUser',
            'PaymentMethod',
            'refUser'
        );

        $this->addForeignKey(
            'fk-paymentMethod-refUser',
            'PaymentMethod',
            'refUser',
            'User',
            'idUser',
            'NO ACTION'
        );

        /**
         * USER NOTIFICATION FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-userNotification-refUser',
            'UserNotification',
            'refUser'
        );

        $this->addForeignKey(
            'fk-userNotification-refUser',
            'UserNotification',
            'refUser',
            'User',
            'idUser',
            'NO ACTION'
        );

        $this->createIndex(
            'idx-userNotification-refNotification',
            'UserNotification',
            'refNotification'
        );

        $this->addForeignKey(
            'fk-userNotification-refNotification',
            'UserNotification',
            'refNotification',
            'Notification',
            'idNotification',
            'NO ACTION'
        );

        /**
         * PRODUCT FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-product-refProductCategory',
            'Product',
            'refProductCategory'
        );

        $this->addForeignKey(
            'fk-product-refProductCategory',
            'Product',
            'refProductCategory',
            'ProductCategory',
            'idProductCategory',
            'NO ACTION'
        );

        $this->createIndex(
            'idx-product-refProductTypology',
            'Product',
            'refProductTypology'
        );

        $this->addForeignKey(
            'fk-product-refProductTypology',
            'Product',
            'refProductTypology',
            'ProductTypology',
            'idProductTypology',
            'NO ACTION'
        );

        $this->createIndex(
            'idx-product-refUser',
            'Product',
            'refUser'
        );

        $this->addForeignKey(
            'fk-product-refUser',
            'Product',
            'refUser',
            'User',
            'idUser',
            'NO ACTION'
        );

        /**
         * AVAILABLE PRODUCT FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-availableProduct-refProduct',
            'AvailableProduct',
            'refProduct'
        );

        $this->addForeignKey(
            'fk-availableProduct-refProduct',
            'AvailableProduct',
            'refProduct',
            'Product',
            'idProduct',
            'NO ACTION'
        );

        /**
         * CART FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-cart-refUser',
            'Cart',
            'refUser'
        );

        $this->addForeignKey(
            'fk-cart-refUser',
            'Cart',
            'refUser',
            'User',
            'idUser',
            'NO ACTION'
        );

        /**
         * CART ITEM FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-cartItem-refCart',
            'CartItem',
            'refCart'
        );

        $this->addForeignKey(
            'fk-cartItem-refCart',
            'CartItem',
            'refCart',
            'Cart',
            'idCart',
            'NO ACTION'
        );

        $this->createIndex(
            'idx-cartItem-refAvailableProduct',
            'CartItem',
            'refAvailableProduct'
        );

        $this->addForeignKey(
            'fk-cartItem-refAvailableProduct',
            'CartItem',
            'refAvailableProduct',
            'AvailableProduct',
            'idAvailableProduct',
            'NO ACTION'
        );

        /**
         * ORDER FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-order-refUser',
            'Order',
            'refUser'
        );

        $this->addForeignKey(
            'fk-order-refUser',
            'Order',
            'refUser',
            'User',
            'idUser',
            'NO ACTION'
        );

        /**
         * ORDER LINE FOREIGN KEY AND INDICES
         */
        $this->createIndex(
            'idx-orderItem-refOrder',
            'OrderItem',
            'refOrder'
        );

        $this->addForeignKey(
            'fk-orderItem-refOrder',
            'OrderItem',
            'refOrder',
            'Order',
            'idOrder',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * ORDER ITEM
         */
        $this->dropForeignKey("fk-orderItem-refOrder", "OrderItem");
        $this->dropIndex("idx-orderItem-refOrder", "OrderItem");
        $this->dropTable("OrderItem");

        /**
         * ORDER
         */
        $this->dropForeignKey("fk-order-refUser", "Order");
        $this->dropIndex("idx-order-refUser", "Order");
        $this->dropTable("Order");

        /**
         * CART ITEM
         */
        $this->dropForeignKey("fk-cartItem-refCart", "CartItem");
        $this->dropForeignKey("fk-cartItem-refAvailableProduct", "CartItem");
        $this->dropIndex("idx-cartItem-refCart", "CartItem");
        $this->dropIndex("idx-cartItem-refAvailableProduct", "CartItem");
        $this->dropTable("CartItem");

        /**
         * CART
         */
        $this->dropForeignKey("fk-cart-refUser", "Cart");
        $this->dropIndex("idx-cart-refUser", "Cart");
        $this->dropTable("Cart");

        /**
         * TAX DATA
         */
        $this->dropForeignKey("fk-user-refTaxData", "User");
        $this-> dropIndex("idx-user-refTaxData", "User");
        $this->dropTable("TaxData");

        /**
         * PAYMENT METHODS
         */
        $this->dropForeignKey("fk-paymentMethod-refUser", "PaymentMethod");
        $this-> dropIndex("idx-paymentMethod-refUser", "PaymentMethod");
        $this->dropTable("PaymentMethod");

        /**
         * NOTIFICATIONS
         */
        $this->dropForeignKey("fk-userNotification-refUser", "UserNotification");
        $this->dropForeignKey("fk-userNotification-refNotification", "UserNotification");
        $this->dropIndex("idx-userNotification-refUser", "UserNotification");
        $this->dropIndex("idx-userNotification-refNotification", "UserNotification");
        $this->dropTable("UserNotification");
        $this->dropTable("Notification");

        /**
         * AVAILABLE PRODUCT
         */
        $this->dropForeignKey("fk-availableProduct-refProduct", "AvailableProduct");
        $this->dropIndex("idx-availableProduct-refProduct", "AvailableProduct");
        $this->dropTable("AvailableProduct");

        /**
         * PRODUCT
         */
        $this->dropForeignKey("fk-product-refProductCategory", "Product");
        $this->dropForeignKey("fk-product-refProductTypology", "Product");
        $this->dropForeignKey("fk-product-refUser", "Product");
        $this->dropIndex("idx-product-refProductCategory", "Product");
        $this->dropIndex("idx-product-refProductTypology", "Product");
        $this->dropIndex("idx-product-refUser", "Product");
        $this->dropTable("Product");

        /**
         * PRODUCT TYPOLOGY
         */
        $this->dropTable("ProductTypology");

        /**
         * PRODUCT CATEGORY
         */
        $this->dropTable("ProductCategory");

        /**
         * USER
         */
        $this->dropTable("User");
    }
}
