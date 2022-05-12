<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UserNotification".
 *
 * @property int $refUser
 * @property int $refNotification
 * @property string|null $readDate
 *
 * @property Notification $refNotification0
 * @property User $refUser0
 */
class UserNotification extends \yii\db\ActiveRecord
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
            [['readDate'], 'safe'],
            [['refUser', 'refNotification'], 'unique', 'targetAttribute' => ['refUser', 'refNotification']],
            [['refNotification'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::className(), 'targetAttribute' => ['refNotification' => 'idNotification']],
            [['refUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['refUser' => 'idUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'refUser' => 'Ref User',
            'refNotification' => 'Ref Notification',
            'readDate' => 'Read Date',
        ];
    }

    /**
     * Gets query for [[RefNotification0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefNotification0()
    {
        return $this->hasOne(Notification::className(), ['idNotification' => 'refNotification']);
    }

    /**
     * Gets query for [[RefUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefUser0()
    {
        return $this->hasOne(User::className(), ['idUser' => 'refUser']);
    }
}
