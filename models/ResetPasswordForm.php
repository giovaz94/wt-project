<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * @var string $email The recovery email
 */
class ResetPasswordForm extends Model
{

    public $email ;

    public function rules()
    {

        return [
            [['email'], 'email'],
            [['email'], 'required'],
            [['email'], 'emailExists']
        ];
    }

    /**
     * Check if a email exists
     * @param $attribute
     * @param $params
     * @return void
     */
    public function emailExists($attribute, $params)
    {
        $model = User::findOne(["email" => $this->email]);
        if(!$model) {
            $this->addError("email", "Please, use a valid email address");
        }
    }

    /**
     * Create a new resetKey for the user and send the recovery email
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function sendRecovery()
    {
        $model = User::findOne(["email" => $this->email]);
        $model->resetKey = \Yii::$app->security->generateRandomString();
        $model->update(false);

        // Send a recovery email to the user
        $mail = Yii::$app->mailer
            ->compose('templates/reset', ['model' => $model])
            ->setFrom('info.campusbooks.media@gmail.com')
            ->setTo($model->email)
            ->setSubject('Richiesta reset password');

        return $mail->send();
    }

}




