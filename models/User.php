<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
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
 * @property int $resetKey
 *
 * @property Cart $cart
 * @property Order[] $orders
 * @property PaymentMethod[] $paymentMethods
 * @property Product[] $products
 * @property Notification[] $refNotifications
 * @property TaxData $taxData
 * @property UserNotification[] $userNotifications
 */
class User extends ActiveRecord implements IdentityInterface
{

    // BUYER SCENARIO
    const SCENARIO_BUYER_REGISTRATION = "buyer-registration";

    // VENDOR SCENARIO
    const SCENARIO_VENDOR_REGISTRATION = "vendor-registration";

    // RESET PASSWORD
    const SCENARIO_RESET_PASSWORD = "reset-password";

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
            [['resetKey'], 'safe'],
            [['resetKey'], 'string'],
            [['firstName', 'lastName', 'email', 'username', 'password', 'password_repeat', 'cityOfBirth'], 'string', 'max' => 255],
            [['dateOfBirth'], 'date', 'format' => 'd/m/Y'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['password_repeat','password'], 'required', 'on' => [self::SCENARIO_VENDOR_REGISTRATION, self::SCENARIO_BUYER_REGISTRATION, self::SCENARIO_RESET_PASSWORD]],
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
        $scenarios[self::SCENARIO_RESET_PASSWORD] = ["password", "password_repeat"];
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
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $products = $this->products;
        foreach ($products as $product) {
            $product->delete();
        }

        $this->cart->delete();
        return parent::beforeDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes)
    {

        $cart = new Cart();
        $cart->refUser = $this->idUser;
        $cart->save();

        $this->link('cart', $cart);
        parent::afterSave($insert, $changedAttributes);
    }


    /**
     * Gets query for [[Carts]].
     *
     * @return ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[PaymentMethods]].
     *
     * @return ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[RefNotifications]].
     *
     * @return ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::class, ['idNotification' => 'refNotification'])->viaTable('UserNotification', ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[UserNotifications]].
     *
     * @return ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::class, ['refUser' => 'idUser']);
    }

    /**
     * Gets query for [[TaxData]].
     *
     * @return ActiveQuery
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
     * ===================
     * BEGIN: UNUSED AUTH METHODS
     * ===================
     */

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

    /**
     * ===================
     * END: UNUSED AUTH METHODS
     * ===================
     */
}
