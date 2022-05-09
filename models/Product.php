<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product".
 *
 * @property int $idProduct
 * @property string $name
 * @property string $description
 * @property string $img
 * @property float $price
 * @property int $totalPages
 * @property string $releaseDate
 * @property string $author
 * @property int|null $refProductCategory
 * @property int|null $refProductTypology
 * @property int|null $refUser
 *
 * @property AvailableProduct[] $availableProducts
 * @property ProductCategory $refProductCategory0
 * @property ProductTypology $refProductTypology0
 * @property User $refUser0
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'img', 'price', 'totalPages', 'releaseDate', 'author'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['totalPages', 'refProductCategory', 'refProductTypology', 'refUser'], 'integer'],
            [['releaseDate'], 'safe'],
            [['name', 'img', 'author'], 'string', 'max' => 255],
            [['refProductCategory'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['refProductCategory' => 'idProductCategory']],
            [['refProductTypology'], 'exist', 'skipOnError' => true, 'targetClass' => ProductTypology::className(), 'targetAttribute' => ['refProductTypology' => 'idProductTypology']],
            [['refUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['refUser' => 'idUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProduct' => 'Id Product',
            'name' => 'Name',
            'description' => 'Description',
            'img' => 'Img',
            'price' => 'Price',
            'totalPages' => 'Total Pages',
            'releaseDate' => 'Release Date',
            'author' => 'Author',
            'refProductCategory' => 'Ref Product Category',
            'refProductTypology' => 'Ref Product Typology',
            'refUser' => 'Ref User',
        ];
    }

    /**
     * Gets query for [[AvailableProducts]].
     *
     * @return \yii\db\ActiveQuery|AvailableProductQuery
     */
    public function getAvailableProducts()
    {
        return $this->hasMany(AvailableProduct::className(), ['refProduct' => 'idProduct']);
    }

    /**
     * Gets query for [[RefProductCategory0]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getRefProductCategory0()
    {
        return $this->hasOne(ProductCategory::className(), ['idProductCategory' => 'refProductCategory']);
    }

    /**
     * Gets query for [[RefProductTypology0]].
     *
     * @return \yii\db\ActiveQuery|ProductTypologyQuery
     */
    public function getRefProductTypology0()
    {
        return $this->hasOne(ProductTypology::className(), ['idProductTypology' => 'refProductTypology']);
    }

    /**
     * Gets query for [[RefUser0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getRefUser0()
    {
        return $this->hasOne(User::className(), ['idUser' => 'refUser']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
