<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "CartItem".
 *
 * @property int $idCartItem
 * @property int $quantity
 * @property float $unitPrice
 * @property float $subtotal
 * @property int|null $refCart
 * @property-read ActiveQuery $cart
 * @property-read ActiveQuery $availableProduct
 * @property int|null $refAvailableProduct
 *
 */
class CartItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CartItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'unitPrice', 'subtotal'], 'required'],
            [['quantity', 'refCart', 'refAvailableProduct'], 'integer'],
            [['unitPrice', 'subtotal'], 'number'],
            [['refAvailableProduct'], 'exist', 'skipOnError' => true, 'targetClass' => AvailableProduct::class, 'targetAttribute' => ['refAvailableProduct' => 'idAvailableProduct']],
            [['refCart'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::class, 'targetAttribute' => ['refCart' => 'idCart']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCartItem' => 'Id Cart Item',
            'quantity' => 'Quantity',
            'unitPrice' => 'Unit Price',
            'subtotal' => 'Subtotal',
            'refCart' => 'Ref Cart',
            'refAvailableProduct' => 'Ref Available Product',
        ];
    }

    /**
     * Gets query for [[RefAvailableProduct0]].
     *
     * @return ActiveQuery
     */
    public function getAvailableProduct()
    {
        return $this->hasOne(AvailableProduct::class, ['idAvailableProduct' => 'refAvailableProduct']);
    }

    /**
     * Gets query for [[RefCart0]].
     *
     * @return ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::class, ['idCart' => 'refCart']);
    }
}
