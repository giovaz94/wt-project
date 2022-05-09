<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property int $idUser
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string|null $dateOfBirth
 * @property string|null $cityOfBirth
 * @property int|null $refTaxData
 *
 * @property Cart[] $carts
 * @property Order[] $orders
 * @property PaymentMethod[] $paymentMethods
 * @property Product[] $products
 * @property Notification[] $refNotifications
 * @property TaxData $refTaxData0
 * @property UserNotification[] $userNotifications
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email', 'username', 'password'], 'required'],
            [['firstName', 'lastName', 'email', 'username', 'password', 'cityOfBirth'], 'string', 'max' => 255],
            [['dateOfBirth'], 'date', 'format' => 'd-m-Y'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['username'], 'unique'],
            [['refTaxData'], 'integer'],
            [['refTaxData'], 'exist', 'skipOnError' => true, 'targetClass' => TaxData::className(), 'targetAttribute' => ['refTaxData' => 'idTaxData']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'dateOfBirth' => 'Date Of Birth',
            'cityOfBirth' => 'City Of Birth',
            'refTaxData' => 'Ref Tax Data',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery|CartQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[PaymentMethods]].
     *
     * @return \yii\db\ActiveQuery|PaymentMethodQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::className(), ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[RefNotifications]].
     *
     * @return \yii\db\ActiveQuery|NotificationQuery
     */
    public function getRefNotifications()
    {
        return $this->hasMany(Notification::className(), ['idNotification' => 'refNotification'])->viaTable('UserNotification', ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[RefTaxData0]].
     *
     * @return \yii\db\ActiveQuery|TaxDataQuery
     */
    public function getRefTaxData0()
    {
        return $this->hasOne(TaxData::className(), ['idTaxData' => 'refTaxData']);
    }

    /**
     * Gets query for [[UserNotifications]].
     *
     * @return \yii\db\ActiveQuery|UserNotificationQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::className(), ['refUser' => 'idUser']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * {@inheritDoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->idUser;
    }

    /**
     * {@inheritDoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthKey()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function validateAuthKey($authKey)
    {
    }
}
