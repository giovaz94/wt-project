<?php

namespace app\controllers;

use app\models\AddToCartForm;
use app\models\Cart;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;


/**
 * @property Cart $cart
 */
class CartController extends Controller
{
    public $cart;

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@']
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $user = User::findOne(Yii::$app->user->id);
        if(!$user || !$user->cart){
            throw new ServerErrorHttpException("Error loading cart");
        }
        $this->cart = $user->cart;
        return parent::beforeAction($action);
    }

    /**
     * Add a new item to the cart.
     * @param $idAvailable int The available product id
     */
    public function actionAddItem($idAvailable)
    {
        $model = new AddToCartForm();
        $model->idAvailable = $idAvailable;
        if($this->request->isPost && $model->load($this->request->post())) {
            if($model->validate()) {
                $model->addItemTo($this->cart);
                return $this->redirect(["index"]);
            }
        } elseif ($this->request->isAjax) {
            return $this->renderAjax("add-item", ["model" => $model]);
        }

        return $this->render("add-item", ["model" => $model]);
    }


    public function actionIndex()
    {
        echo "yai";
        die;
    }


}