<?php

namespace app\controllers;

use app\models\AddToCartForm;
use app\models\Cart;
use app\models\CartItem;
use app\models\CheckoutForm;
use app\models\Notification;
use app\models\Order;
use app\models\OrderItem;
use app\models\User;
use app\utils\NotificationFactory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
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
            throw new ServerErrorHttpException("Errore caricamento carrello");
        }
        $this->cart = $user->cart;
        return parent::beforeAction($action);
    }

    /**
     * Add a new product to the cart
     * @param $idAvailable
     * @return Response
     */
    public function actionAddToCart($idAvailableProduct)
    {
        $model = new AddToCartForm();
        $model->idAvailable = $idAvailableProduct;
        $model->quantity = 1;

        if ($model->validate()) {
            $model->addItemTo($this->cart);
            return $this->redirect(["index"]);
        }
        return $this->redirect(['search/detail', 'idAvailableProduct' => $idAvailableProduct]);
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
        $operationMsg = "Carrello aggiornato con successo!";
        $errorDetail = "";

        $model->quantity = Yii::$app->request->post("quantity");

        if(!$model->update()) {
            $operationResult = 1;
            $operationMsg = "Errore, aggiornamento carrello non riuscito";
            $errorDetail = $model->firstErrors;
        }

        return [
            "result" => $operationResult,
            "message" => $operationMsg,
            "error-detail" => $errorDetail
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

            $user = User::findOne(Yii::$app->user->id);
            $link = Html::a("Ordine", Url::to(["order/detail", "idOrder" => $order->idOrder], true));

            $title = "Ordine Completato";
            $body = <<<BODY
            Gentile {$user->firstName} {$user->lastName}, grazie per il tuo acquisto.
            Ti informiamo che il tuo ordine è stato creato. Puoi trovare un riepilogo alla pagina {$link}.
BODY;

            NotificationFactory::sendToUser("Ordine completato", $body, $user);

            return $this->redirect(['site/index']);
        }

        $this->layout = "clear";
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

        return $this->render("index", [
            'dataProvider' => $dataProvider,
            'cart' => $this->cart,
        ]);
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