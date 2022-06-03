<?php

namespace app\models;

use app\utils\NotificationFactory;
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

    const SCENARIO_CHECKOUT = "checkout";

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
    public function beforeSave($insert)
    {
        $availableProduct = AvailableProduct::findOne($this->refAvailableProduct);
        if (!$availableProduct) {
            return false;
        }

        if(!$insert) {
            // Require quantity for this item.
            $oldQuantity = $this->getOldAttribute("quantity");
            $diff = $this->quantity - (empty($oldQuantity) ? 0 : $oldQuantity);

            // Add all the product availability to the cart item.
            if($availableProduct->availability < $diff) {
                return false;
            }
        }
        // Calculate the subtotal.
        $this->subtotal = $availableProduct->sellingPrice * $this->quantity;
        return parent::beforeSave($insert);
    }


    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes)
    {
        $availableProduct = $this->availableProduct;
        $isUpdating = !$insert && $availableProduct;

        if($isUpdating) {
            // Difference of quantity
            $isQtyChanged = !empty($changedAttributes["quantity"]);
            $diff =  $isQtyChanged ? $this->quantity - $changedAttributes["quantity"] : 0;

            // If the difference between the product availability and the
            // cart item quantity is negative then the result should be all the product availability.
            $result = $availableProduct->availability - $diff;
            $availableProduct->availability -= $result < 0 ? $availableProduct->availability : $diff;

            // Update the item.
            $availableProduct->update(false);
        }
        $this->cart->updateTotal();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $availableProduct = $this->availableProduct;
        if($this->scenario != self::SCENARIO_CHECKOUT) {
            $availableProduct->availability += $this->quantity;
            $availableProduct->update(false);
        } else if($availableProduct->availability == 0) {

            $title = "Product {$availableProduct->product->name} sold out!";
            $body = <<<BODY
            
            If you receive this notification is because the product "{$availableProduct->product->name}"
            is now sold out.
            
            Thank you for your attention.
BODY;
            NotificationFactory::sendToUser($title, $body, $this->availableProduct->product->user);
        }

        return parent::beforeDelete(); // TODO: Change the autogenerated stub
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
