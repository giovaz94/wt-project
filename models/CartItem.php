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
 * @property float $subtotal
 * @property int|null $refCart
 * @property-read Cart $cart
 * @property-read AvailableProduct $availableProduct
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
            [['quantity', 'subtotal'], 'required'],
            [['quantity', 'refCart', 'refAvailableProduct'], 'integer'],
            [['subtotal'], 'number'],
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
            'subtotal' => 'Subtotal',
            'refCart' => 'Ref Cart',
            'refAvailableProduct' => 'Ref Available Product',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes)
    {
        $availableProduct = AvailableProduct::findOne($this->refAvailableProduct);
        if(!$insert && $availableProduct) {
            $isQtyChanged = $changedAttributes["quantity"];
            $diff =  $this->quantity - ($isQtyChanged ? $changedAttributes["quantity"] : 0);
            $result = $availableProduct->availability - $diff;
            $result = $result < 0 ? $availableProduct->availability : $availableProduct->availability - $diff;
            $availableProduct->availability -= $result;
            $availableProduct->update(false);
        }
        parent::afterSave($insert, $changedAttributes);
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
