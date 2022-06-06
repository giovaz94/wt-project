<?php

namespace app\utils;

use Yii;

class NotificationFactory
{
    /**
     * Generate a new notification
     *
     * @param $title string title of the notification.
     * @param $body  string body of the notification
     * @param $users \app\models\User|array  a User active record or an array of user active records
     * @return \app\models\Notification The generated notification
     * @throws \yii\base\Exception if the notification can't be saved
     */
    private static function _generateNotification($title, $body, $users) {

        $notification = new \app\models\Notification();
        $notification->title = $title;
        $notification->body = $body;

        $isSaved = $notification->save();
        $messages = [];
        if($isSaved) {
            if(is_array($users)) {
                foreach ($users as $user) {
                    $notification->link('users', $user);
                    $messages[] = $mail = Yii::$app->mailer
                        ->compose('templates/notification', ['user' => $user, 'notification' => $notification])
                        ->setFrom('info.campusbooks.media@gmail.com')
                        ->setTo($user->email)
                        ->setSubject('Nuova notifica');
                }
            } else {
                $notification->link('users', $users);
                $messages[] = $mail = Yii::$app->mailer
                    ->compose('templates/notification', ['user' => $users, 'notification' => $notification])
                    ->setFrom('info.campusbooks.media@gmail.com')
                    ->setTo($users->email)
                    ->setSubject('Nuova notifica');
            }

            Yii::$app->mailer->sendMultiple($messages);
            return $notification;
        }

        var_dump($notification->firstErrors); die;
        throw new \yii\base\Exception("Errore salvataggio notifica");
    }

    /**
     * Generate a global notification.
     *
     * @param $title string title of the notification
     * @param $body  string body of the notification
     * @return \app\models\Notification The generated notification
     * @throws \yii\base\Exception if the notification can't be saved
     */
    public static function globalNotification($title, $body) {
        return self::_generateNotification($title, $body, \app\models\User::find()->all());
    }


    /**
     * Single notification to user
     *
     * @param $title string title of the notification
     * @param $body  string body of the notification
     * @param $user  \app\models\User The target User active record
     * @return \app\models\Notification The generated notification
     * @throws \yii\base\Exception if the notification can't be saved
     */
    public static function sendToUser($title, $body, $user) {
        return self::_generateNotification($title, $body, $user);
    }
}