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
 * @property string $publication
 * @property int|null $refProductCategory
 * @property int|null $refProductTypology
 * @property int|null $refUser
 * @property null|string $imageUrl
 *
 * @property-read User $user
 * @property-read ProductCategory $category
 * @property-read ProductTypology $typology
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
            [['name', 'description', 'price', 'totalPages', 'publication', 'author', 'refProductTypology', 'refProductCategory'], 'required'],
            [['img'], 'required', 'message' => 'Please, upload an image'],
            [['totalPages', 'refProductCategory', 'refProductTypology', 'refUser'], 'integer'],
            [['name', 'img', 'author'], 'string', 'max' => 255],
            [['fileLoader'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['publication'], 'date', 'format' => 'php:Y-m-d'],
            [['releaseDate'], 'date', 'format' => 'php:Y-m-d'],
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
                    ActiveRecord::EVENT_BEFORE_INSERT => 'publication',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'publication',
                ],
                'value' => function ($event) {
                    return Yii::$app->formatter->asDate($this->publication, 'php:Y-m-d');
                },
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'releaseDate',
                    ActiveRecord::EVENT_BEFORE_UPDATE => false,
                ],
                'value' => function ($event) {
                    return Yii::$app->formatter->asDate("now", 'php:Y-m-d');
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
            'idProduct' => 'Id Prodotto',
            'name' => 'Nome',
            'description' => 'Descrizione',
            'img' => 'Immagine',
            'price' => 'Prezzo',
            'totalPages' => 'Pagine totali',
            'releaseDate' => 'Data rilascio vendita',
            'publication' => 'Data pubblicazione',
            'author' => 'Autore',
            'refProductCategory' => 'Riferimento alla categoria',
            'refProductTypology' => 'Riferimento alla tipologia',
            'refUser' => 'Riferimento utente',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $availableProducts = $this->availableProducts;
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

    public function countTotalAvailability()
    {
        return $this->getAvailableProducts()->sum("availability");
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
