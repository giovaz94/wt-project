<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Order".
 *
 * @property int $idOrder
 * @property string $dateOfCreation
 * @property float $total
 * @property int|null $refUser
 *
 * @property OrderItem[] $orderItems
 * @property User $user
 */
class Order extends ActiveRecord
{
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
            [['total'], 'required'],
            [['dateOfCreation'], 'date', 'format' => 'php:Y-m-d'],
            [['total'], 'number'],
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
