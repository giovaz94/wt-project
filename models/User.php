<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
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
class User extends ActiveRecord implements IdentityInterface
{

    // BUYER SCENARIOS
    const SCENARIO_BUYER_REGISTRATION = "buyer-registration";

    // VENDOR SCENARIOS
    const SCENARIO_VENDOR_REGISTRATION = "vendor-registration";

    // LOGIN SCENARIO
    const SCENARIO_LOGIN = "login";

    // UPDATE SCENARIO
    const SCENARIO_UPDATE = "update";

    // Password repeat attribute
    public $password_repeat;

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
            [['firstName', 'lastName', 'email', 'username'], 'required'],
            [['firstName', 'lastName', 'email', 'username', 'password', 'password_repeat', 'cityOfBirth'], 'string', 'max' => 255],
            [['dateOfBirth'], 'date', 'format' => 'd/m/Y'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['password_repeat','password'], 'required', 'on' => [self::SCENARIO_VENDOR_REGISTRATION, self::SCENARIO_BUYER_REGISTRATION]],
            ['password_repeat', 'compare', 'compareAttribute'=>'password',
                'message'=>"Passwords should match between each other",
                'skipOnEmpty' => false ,
                'when' => function ($model) {
                    return !empty($model->password);
            },],
            [['username'], 'unique'],
            [['refTaxData'], 'integer'],
            [['refTaxData'], 'exist', 'skipOnError' => true, 'targetClass' => TaxData::class, 'targetAttribute' => ['refTaxData' => 'idTaxData']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];
        $scenarios[self::SCENARIO_BUYER_REGISTRATION] = ['firstName', 'lastName', 'email', 'username', 'password', 'password_repeat', 'dateOfBirth', 'cityOfBirth'];
        $scenarios[self::SCENARIO_VENDOR_REGISTRATION] = ['firstName', 'lastName', 'email', 'username', 'password', 'password_repeat', 'dateOfBirth', 'cityOfBirth', 'refTaxData'];
        $scenarios[self::SCENARIO_UPDATE] = ['firstName', 'lastName', 'email', 'username', 'password', 'password_repeat', 'dateOfBirth', 'cityOfBirth'];
        return $scenarios;
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
                    ActiveRecord::EVENT_BEFORE_INSERT => 'dateOfBirth',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'dateOfBirth',
                ],
                'value' => function ($event) {
                    return Yii::$app->formatter->asDate($this->dateOfBirth, 'php:Y/m/d');
                },
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'password',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'password',
                ],
                'value' => function ($event) {
                    if(!empty($this->getDirtyAttributes(["password"])["password"])) {
                        $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                    } else {
                        $hash = $this->getOldAttribute("password");
                    }
                    return $hash;
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
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[PaymentMethods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[RefNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::class, ['idNotification' => 'refNotification'])->viaTable('UserNotification', ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[UserNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[TaxData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxData()
    {
        return $this->hasOne(TaxData::class, ['idTaxData' => 'refTaxData']);
    }

    /**
     * Find a user by its username
     *
     * @param string $username the username
     * @return User
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
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
