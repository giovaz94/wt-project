<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "Order".
 *
 * @property int $idOrder
 * @property int $status
 * @property string $dateOfCreation
 * @property float $total
 * @property int|null $refUser
 *
 * @property OrderItem[] $orderItems
 * @property User $user
 */
class Order extends ActiveRecord
{
    const ORDER_CREATE = 1;
    const ORDER_SENT = 2;
    const ORDER_DELIVERED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total', 'status'], 'required'],
            [['dateOfCreation'], 'date', 'format' => 'php:Y-m-d'],
            [['total'], 'number'],
            [['status'], 'in', 'range' => [self::ORDER_CREATE, self::ORDER_SENT, self::ORDER_DELIVERED]],
            [['status'], 'default', 'value' => self::ORDER_CREATE],
            [['refUser'], 'integer'],
            [['refUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['refUser' => 'idUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'dateOfCreation',
                    ActiveRecord::EVENT_BEFORE_UPDATE => false,
                ],
                'value' => function ($event) {
                    return Yii::$app->formatter->asDate("now", 'php:Y-m-d');
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idOrder' => 'Id Order',
            'dateOfCreation' => 'Date Of Creation',
            'total' => 'Total',
            'refUser' => 'Ref User',
        ];
    }

    /**
     * Return the count of the total items in the order
     * @return bool|int|mixed|string|null
     */
    public function getItemCount()
    {
        return $this->getOrderItems()->sum("quantity");
    }

    /**
     * Return the order tax
     * @param $tax
     * @return float|int
     */
    public function getOrderTax($tax = 22)
    {
        return $this->total * ($tax / 100);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['refOrder' => 'idOrder']);
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
