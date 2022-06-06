<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Cart".
 *
 * @property int $idCart
 * @property float $total
 * @property int $refUser
 *
 * @property-read User $user
 * @property CartItem[] $cartItems
 */
class Cart extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total'], 'number'],
            [['refUser'], 'integer'],
            [['refUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['refUser' => 'idUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCart' => 'Id Cart',
            'total' => 'Totale',
            'refUser' => 'Riferimento Utente',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function beforeDelete()
    {
        $cartItems = $this->cartItems;
        foreach ($cartItems as $item) {
            $item->delete();
        }
        return parent::beforeDelete();
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return ActiveQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::class, ['refCart' => 'idCart']);
    }

    /**
     * Gets query for [[RefUser0]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['idUser' => 'refUser']);
    }

    /**
     * Update the total of the cart
     * @return false|int
     * @throws \yii\db\StaleObjectException
     */
    public function updateTotal()
    {
        $cartItems = $this->cartItems;
        $total = 0.0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem->subtotal;
        }

        $this->total = $total;
        return $this->update();
    }
}
