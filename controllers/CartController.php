<?php

namespace app\controllers;

use app\models\AddToCartForm;
use app\models\Cart;
use app\models\CartItem;
use app\models\User;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
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
     * Add a new cart item.
     * @param $idAvailable
     * @return string|Response
     */
    public function actionAddItem($idAvailable)
    {
        $model = new AddToCartForm();
        $model->idAvailable = $idAvailable;

        if ($model->load($this->request->post()) && $model->validate()) {
            $model->addItemTo($this->cart);
            return $this->redirect(["index"]);
        }

        if($this->request->isAjax) {
            return $this->renderAjax("_form", ["model" => $model]);
        }

        return $this->render("_form", ["model" => $model]);
    }

    /**
     * Update an existing cart item.
     * @param $idCartItem
     * @return string|Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     */
    public function actionUpdateItem($idCartItem)
    {
        $model = $this->findModel($idCartItem);
        if ($model->load($this->request->post()) && $model->update()) {
            return $this->redirect(["index"]);
        }

        if($this->request->isAjax) {
            return $this->renderAjax("_form", ["model" => $model]);
        }

        return $this->render("_form", ["model" => $model]);
    }

    /**
     * Remove an item from the cart
     * @param $idCartItem
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException|ServerErrorHttpException
     */
    public function actionRemoveItem($idCartItem)
    {
        $model = $this->findModel($idCartItem);
        if(!$model) {
            throw new ServerErrorHttpException("Error loading cart item");
        }
        $model->delete();
        return $this->redirect(["index"]);
    }

    /**
     * @return void
     */
    public function actionIndex()
    {
        echo "yai";
        die;
    }

    /**
     * Find a cart item model
     * @param $idCartItem
     * @return array|CartItem
     * @throws NotFoundHttpException
     */
    protected function findModel($idCartItem)
    {
        $cartItem =  $this->cart->getCartItems()
            ->andWhere(["idCartItem" => $idCartItem])
            ->one();

        if(!$cartItem) {
            throw new NotFoundHttpException("Item not found");
        }

        return $cartItem;
    }


}