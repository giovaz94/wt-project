<?php

namespace app\utils;

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
        if($isSaved) {
            if(is_array($users)) {
                foreach ($users as $user) {
                    $notification->link('users', $user);
                }
            } else {
                $notification->link('users', $users);
            }

            return $notification;

        }

        throw new \yii\base\Exception("Error saving the notification");
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