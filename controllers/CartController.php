<?php

namespace app\controllers;

use app\models\AddToCartForm;
use app\models\Cart;
use app\models\CartItem;
use app\models\CheckoutForm;
use app\models\Order;
use app\models\OrderItem;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
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
     * Increase the quantity of a cart item
     * @param $idCartItem
     */
    public function actionEditQuantity($idCartItem)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($idCartItem);

        $operationResult = 0;
        $operationMsg = "Cart updated successfully!";

        $model->quantity = Yii::$app->request->post("quantity");
        if(!$model->update()) {
            $operationResult = 1;
            $operationMsg = "Error, can't update the cart";
        }

        // Return the response from the server
        return [
            "result" => $operationResult,
            "message" => $operationMsg
        ];
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
     * Checkout
     * @throws ServerErrorHttpException
     */
    public function actionCheckout()
    {
        if (!$this->cart) {
            throw new ServerErrorHttpException("Can't found the user's cart");
        }

        if($this->cart->getCartItems()->count() == 0) {
            return $this->redirect(['site/index']);
        }

        $model = new CheckoutForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            // Create a new order
            $order = new Order();
            $order->status = Order::ORDER_CREATE;
            $order->total = 0.0;
            $order->refUser = Yii::$app->user->id;
            $order->save();

            $orderTotal = 0.0;
            foreach ($this->cart->cartItems as $cartItem) {

                // Create an order item
                $orderItem = new OrderItem();
                $orderItem->name = $cartItem->availableProduct->product->name;
                $orderItem->unitPrice = $cartItem->availableProduct->sellingPrice;
                $orderItem->description = $cartItem->availableProduct->product->description;
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->subtotal = $cartItem->subtotal;
                $orderItem->img = $cartItem->availableProduct->product->img;
                $orderItem->save();
                $order->link("orderItems", $orderItem);

                $orderTotal += $orderItem->subtotal;

                $ap = $cartItem->availableProduct;
                $cartItem->scenario = CartItem::SCENARIO_CHECKOUT;
                $cartItem->delete();
                if($ap->availability <= 0 ) {
                    $ap->delete();
                }
            }

            // Update total
            $order->total = $orderTotal;
            $order->update();

            return $this->redirect(['site/index']);
        }

        return $this->render("checkout", ['model' => $model]);
    }

    /**
     * Render the cart
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->cart->getCartItems(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render("index", ['dataProvider' => $dataProvider]);
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