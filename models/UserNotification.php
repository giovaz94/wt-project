<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "UserNotification".
 *
 * @property int $refUser
 * @property int $refNotification
 * @property-read ActiveQuery $user
 * @property-read ActiveQuery $notification
 * @property string|null $readDate
 *
 */
class UserNotification extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'UserNotification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['refUser', 'refNotification'], 'required'],
            [['refUser', 'refNotification'], 'integer'],
            [['readDate'], 'datetime', "format" => "php:Y-m-d H:m:i"],
            [['refUser', 'refNotification'], 'unique', 'targetAttribute' => ['refUser', 'refNotification']],
            [['refNotification'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::class, 'targetAttribute' => ['refNotification' => 'idNotification']],
            [['refUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['refUser' => 'idUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'refUser' => 'Riferimento utente',
            'refNotification' => 'Riferimento notifiche',
            'readDate' => 'Data lettura',
        ];
    }

    /**
     * Gets query for [[RefNotification0]].
     *
     * @return ActiveQuery
     */
    public function getNotification()
    {
        return $this->hasOne(Notification::class, ['idNotification' => 'refNotification']);
    }

    /**
     * Gets query for [[RefUser]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['idUser' => 'refUser']);
    }
}
