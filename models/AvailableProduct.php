<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "AvailableProduct".
 *
 * @property int $idAvailableProduct
 * @property int $availability
 * @property float $sellingPrice
 * @property int|null $refProduct
 *
 * @property CartItem[] $cartItems
 */
class AvailableProduct extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AvailableProduct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['availability'], 'required'],
            [['availability', 'refProduct'], 'integer'],
            [['sellingPrice'], 'number'],
            [['refProduct'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['refProduct' => 'idProduct']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAvailableProduct' => 'Id Available Product',
            'availability' => 'Availability',
            'sellingPrice' => 'Selling Price',
            'refProduct' => 'Ref Product',
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return ActiveQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::class, ['refAvailableProduct' => 'idAvailableProduct']);
    }

    /**
     * Gets query for [[RefProduct0]].
     *
     * @return ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['idProduct' => 'refProduct']);
    }
}
