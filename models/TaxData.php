<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TaxData".
 *
 * @property int $idTaxData
 * @property string $businessName
 * @property string $vatNumber
 * @property string $businessAddress
 * @property string $businessCity
 *
 * @property User[] $users
 */
class TaxData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TaxData';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['businessName', 'vatNumber', 'businessAddress', 'businessCity'], 'required'],
            [['businessName', 'vatNumber', 'businessAddress', 'businessCity'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTaxData' => 'Id Tax Data',
            'businessName' => 'Nome aziendale',
            'vatNumber' => 'Numero VAT',
            'businessAddress' => 'Indirizzo aziendale',
            'businessCity' => 'Città',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['refTaxData' => 'idTaxData']);
    }
}
