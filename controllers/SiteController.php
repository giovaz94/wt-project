<?php

namespace app\controllers;

use app\models\AvailableProduct;
use app\models\SearchForm;
use Yii;

use app\models\ContactForm;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Last inserted
        $li = AvailableProduct::find()
            ->joinWith("product")
            ->orderBy(["Product.releaseDate" => SORT_DESC])
            ->limit(10)
            ->all();

        // Promotions
        $pr = AvailableProduct::find()
            ->joinWith("product")
            ->where("AvailableProduct.sellingPrice < Product.price")
            ->limit(10)
            ->all();

        // Ebook category
        $eb = AvailableProduct::find()
            ->joinWith("product.typology")
            ->andWhere(['=', 'ProductTypology.name', 'E-book'])
            ->limit(10)
            ->all();


        return $this->render('index', [
            'li' => $li,
            'pr' => $pr,
            'eb' => $eb
        ]);
    }
}
