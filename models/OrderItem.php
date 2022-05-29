<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "OrderItem".
 *
 * @property int $idOrderLine
 * @property string $name
 * @property string $img
 * @property string $description
 * @property float $unitPrice
 * @property int $quantity
 * @property float $subtotal
 * @property int|null $refOrder
 *
 * @property Order $order
 */
class OrderItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OrderItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'img', 'description', 'unitPrice', 'quantity', 'subtotal'], 'required'],
            [['description'], 'string'],
            [['unitPrice', 'subtotal'], 'number'],
            [['quantity', 'refOrder'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255],
            [['refOrder'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['refOrder' => 'idOrder']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idOrderLine' => 'Id Order Line',
            'name' => 'Name',
            'img' => 'Img',
            'description' => 'Description',
            'unitPrice' => 'Unit Price',
            'quantity' => 'Quantity',
            'subtotal' => 'Subtotal',
            'refOrder' => 'Ref Order',
        ];
    }

    /**
     * Gets query for [[RefOrder0]].
     *
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['idOrder' => 'refOrder']);
    }
}
