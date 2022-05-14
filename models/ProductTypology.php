<?php

namespace app\models;

use Yii;
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
            'idProductTypology' => 'Id Product Typology',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['refProductTypology' => 'idProductTypology']);
    }
}
