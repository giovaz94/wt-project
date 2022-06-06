<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CheckoutForm extends Model
{

    public $creditCardNumber;
    public $creditCardSecureNumber;
    public $creditCardOwnerName;
    public $creditCardOwnerSurname;
    public $expiryDate;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creditCardNumber', 'creditCardSecureNumber', 'creditCardOwnerName', 'creditCardOwnerSurname', 'expiryDate'], 'required'],
            [['creditCardSecureNumber', 'creditCardSecureNumber'], 'integer'],
            [['expiryDate'], 'date', 'format' => 'php:Y-m-d'],
            [['expiryDate'], 'validateExpiringDate'],
            [['creditCardOwnerName', 'creditCardOwnerSurname'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'creditCardNumber' => 'Carta di credito',
            'creditCardSecureNumber' => 'Numero di sicurezza carta di credito',
            'expiryDate' => 'Data scadenza',
            'creditCardOwnerName' => 'Nome Possessore',
            'creditCardOwnerSurname' => 'Cognome Possessore',
        ];
    }


    /**
     * Validate the expiringDate field of the model.
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    public function validateExpiringDate() {

        $exp = strtotime($this->expiryDate);
        $today = strtotime(Yii::$app->formatter->asDatetime('now', 'php:Y-m-d'));

        if($exp <= $today) {
            $this->addError('expiringDate', 'Invalid expiration date'  );
        }
    }
}