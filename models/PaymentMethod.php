<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "PaymentMethod".
 *
 * @property int $idPaymentMethod
 * @property int $creditCardNumber
 * @property int $creditCardSecurity
 * @property string $expiringDate
 * @property string $ownerFirstName
 * @property string $ownerLastName
 *
 * @property User $refUser
 */
class PaymentMethod extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PaymentMethod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creditCardNumber', 'creditCardSecurity', 'expiringDate', 'ownerFirstName', 'ownerLastName'], 'required'],
            [['creditCardNumber', 'creditCardSecurity', 'refUser'], 'integer'],
            [['expiringDate'], 'date', 'format' => 'd/m/Y'],
            [['expiringDate'], 'validateExpiringDate'],
            [['ownerFirstName', 'ownerLastName'], 'string', 'max' => 255],
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
                    ActiveRecord::EVENT_BEFORE_INSERT => 'expiringDate',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'expiringDate',
                ],
                'value' => function ($event) {
                    return Yii::$app->formatter->asDate($this->expiringDate, 'php:Y/m/d');
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
            'idPaymentMethod' => 'Id Payment Method',
            'creditCardNumber' => 'Carta di credito',
            'creditCardSecurity' => 'Numero sicurezza',
            'expiringDate' => 'Data scadenza carta',
            'ownerFirstName' => 'Nome',
            'ownerLastName' => 'Cognome',
            'refUser' => 'Riferimento utente',
        ];
    }

    /**
     * Gets query for [[RefUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['idUser' => 'refUser']);
    }


    /**
     * Validate the expiringDate field of the model.
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    public function validateExpiringDate() {

        $exp = strtotime($this->expiringDate);
        $today = strtotime(Yii::$app->formatter->asDatetime('now', 'php:Y-m-d'));

        if($exp <= $today) {
            $this->addError('expiringDate', 'Invalid expiration date'  );
        }
    }


}