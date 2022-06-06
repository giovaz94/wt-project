<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "Notification".
 *
 * @property int $idNotification
 * @property string $title
 * @property string $body
 * @property string $dateOfCreation
 *
 * @property User[] $refUsers
 * @property-read ActiveQuery $users
 * @property UserNotification[] $userNotifications
 */
class Notification extends ActiveRecord
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
            [['title', 'body',], 'required'],
            [['title'], 'string', 'max' => 255],
            [['body'], 'string'],
            [['dateOfCreation'], 'datetime'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'dateOfCreation',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
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
     * Gets query for User
     *
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['idUser' => 'refUser'])->viaTable('UserNotification', ['refNotification' => 'idNotification']);
    }

    /**
     * Gets query for UserNotification
     * @return ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::class, ['refNotification' => 'idNotification']);
    }
}
