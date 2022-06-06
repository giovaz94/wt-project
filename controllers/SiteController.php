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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
