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
 * @property-read ActiveQuery $user
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
            [['refUser'], 'required'],
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
            'total' => 'Total',
            'refUser' => 'Ref User',
        ];
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
}
