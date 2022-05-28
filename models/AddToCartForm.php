<?php

namespace app\models;

use yii\base\Model;

class AddToCartForm extends Model
{
    public $quantity;
    public $idAvailable;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['quantity', 'idAvailable'], 'required'],
            [['quantity', 'idAvailable'], 'integer'],
            [['idAvailable'], 'exist', 'skipOnError' => true, 'targetClass' => AvailableProduct::class, 'targetAttribute' => ['idAvailable' => 'idAvailableProduct']]
        ];
    }

    /**
     * Add a cart line item.
     *
     * @param $cart Cart The cart where the line item should be added
     */
    public function addItemTo($cart)
    {

        $availableProduct = AvailableProduct::findOne($this->idAvailable);
        if(!$availableProduct) {
            return false;
        }

        $cartItem = $cart->getCartItems()
            ->andWhere(["refAvailableProduct" => $this->idAvailable])
            ->one();

        if(!$cartItem) {
            $cartItem = new CartItem();

            if($availableProduct->availability < $this->quantity) {
                return false;
            }

            $cartItem->quantity = $this->quantity;
            $availableProduct->availability -= $this->quantity;
            $availableProduct->update(false);

            $cartItem->refAvailableProduct = $availableProduct->idAvailableProduct;
            $cartItem->refCart = $cart->idCart;
            $cartItem->subtotal = $cartItem->quantity * $availableProduct->sellingPrice;
            $cartItem->save();

            return true;
        }

        if ($availableProduct->availability < $this->quantity ) {
            return false;
        }

        $cartItem->quantity += $this->quantity;
        $cartItem->subtotal = $cartItem->quantity * $cartItem->availableProduct->sellingPrice;

        return $cartItem->update();
    }
}