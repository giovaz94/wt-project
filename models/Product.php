<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;
use yii\web\UploadedFile;


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
 * @property null|string $imageUrl
 *
 * @property-read ActiveQuery $user
 * @property-read ActiveQuery $category
 * @property-read ActiveQuery $typology
 * @property AvailableProduct[] $availableProducts
 */
class Product extends ActiveRecord
{

    // Used for loading the image of the product
    public $fileLoader;

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
            [['name', 'description', 'price', 'totalPages', 'releaseDate', 'author'], 'required'],
            [['img'], 'required', 'message' => 'Please, upload an image'],
            [['totalPages', 'refProductCategory', 'refProductTypology', 'refUser'], 'integer'],
            [['name', 'img', 'author'], 'string', 'max' => 255],
            [['fileLoader'], 'file', 'extensions' => 'png, jpg'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['releaseDate'], 'date', 'format' => 'd/m/Y'],
            [['refProductCategory'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['refProductCategory' => 'idProductCategory']],
            [['refProductTypology'], 'exist', 'skipOnError' => true, 'targetClass' => ProductTypology::class, 'targetAttribute' => ['refProductTypology' => 'idProductTypology']],
            [['refUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['refUser' => 'idUser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'releaseDate',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'releaseDate',
                ],
                'value' => function ($event) {
                    return Yii::$app->formatter->asDate($this->releaseDate, 'php:Y/m/d');
                },
            ],
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
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $availableProducts = $this->getAvailableProducts()->all();
        foreach ($availableProducts as $availableProduct){
            $availableProduct->delete();
        }
        return parent::beforeDelete();
    }

    /**
     * Gets query for [[AvailableProducts]].
     *
     * @return ActiveQuery
     */
    public function getAvailableProducts()
    {
        return $this->hasMany(AvailableProduct::class, ['refProduct' => 'idProduct']);
    }

    /**
     * Gets query for [[RefProductCategory0]].
     *
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['idProductCategory' => 'refProductCategory']);
    }

    /**
     * Gets query for [[RefProductTypology0]].
     *
     * @return ActiveQuery
     */
    public function getTypology()
    {
        return $this->hasOne(ProductTypology::class, ['idProductTypology' => 'refProductTypology']);
    }

    /**
     * Gets query for [[RefUser0]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['idUser' => 'refUser']);
    }

    /**
     * Upload an image, save the filename
     * @throws StaleObjectException
     * @throws Exception
     */
    public function uploadImage() {
        $image = UploadedFile::getInstance($this, 'fileLoader');
        if (empty($image)) {
            return false;
        }
        $this->img = Yii::$app->security->generateRandomString() . "." .$image->extension;
        return $image;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() {
        return isset($this->img) ? Yii::getAlias('@webroot/uploads') . "/$this->img" : null;
    }

    /**
     * Process deletion of image
     * @return boolean the status of deletion
     */
    public function deleteImage() {
        $file = $this->getImageUrl();

        if (empty($file) || !file_exists($file)) {
            return false;
        }

        if (!unlink($file)) {
            return false;
        }

        $this->img = null;

        return true;
    }
}
