<?php

namespace app\controllers;

use app\models\Order;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{


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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->andWhere(['refUser' => Yii::$app->user->id])
        ]);

        return $this->render("index", [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDetail($idOrder)
    {
        // Implemento la logica del dettaglio del prodotto
        $model = $this->findModel($idOrder);

        // return $this->render("detail", [
        //  'model' => $model
        //]);
    }


    /**
     * Finds the logged user Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idOrder Id Order
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idOrder)
    {
        if (($model = Order::findOne(['idOrder' => $idOrder, 'refUser' => Yii::$app->user->id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');

    }
}