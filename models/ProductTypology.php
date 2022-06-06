<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ProductTypology".
 *
 * @property int $idProductTypology
 * @property string $name
 * @property string|null $description
 *
 * @property Product[] $products
 */
class ProductTypology extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ProductTypology';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProductTypology'], 'int'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProductTypology' => 'Id Tipologia di prodotto',
            'name' => 'Nome',
            'description' => 'Descrizione',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['refProductTypology' => 'idProductTypology']);
    }
}
