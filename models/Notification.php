<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Notification".
 *
 * @property int $idNotification
 * @property string $title
 * @property string $body
 * @property string $dateOfCreation
 *
 * @property User[] $refUsers
 * @property UserNotification[] $userNotifications
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'dateOfCreation'], 'required'],
            [['body'], 'string'],
            [['dateOfCreation'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idNotification' => 'Id Notification',
            'title' => 'Title',
            'body' => 'Body',
            'dateOfCreation' => 'Date Of Creation',
        ];
    }

    /**
     * Gets query for [[RefUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefUsers()
    {
        return $this->hasMany(User::className(), ['idUser' => 'refUser'])->viaTable('UserNotification', ['refNotification' => 'idNotification']);
    }

    /**
     * Gets query for [[UserNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::className(), ['refNotification' => 'idNotification']);
    }
}
