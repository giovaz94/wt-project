<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ProductTypology".
 *
 * @property int $idProductTypology
 * @property string $name
 * @property string|null $description
 *
 * @property Product[] $products
 */
class ProductTypology extends \yii\db\ActiveRecord
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
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['refProductTypology' => 'idProductTypology']);
    }

    /**
     * {@inheritdoc}
     * @return ProductTypologyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductTypologyQuery(get_called_class());
    }
}