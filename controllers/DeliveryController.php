<?php

namespace app\controllers;

use app\models\Order;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class DeliveryController extends \yii\web\Controller
{

    /**
     * @return array
     */
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
                            'roles' => ['deliver']
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * List the orders
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => Order::find()]);
        return $this->render("index", ["dataProvider" => $dataProvider]);
    }

    /**
     * Update status view
     * @param $idOrder
     * @return \yii\web\Response | string
     */
    public function actionUpdateStatus($idOrder)
    {
        $model = Order::findOne($idOrder);
        if(!$model) {
            throw new NotFoundHttpException("Ordine non trovato");
        }

        $model->scenario = Order::SCENARIO_MODIFY_STATUS;

        if($model->load(Yii::$app->request->post()) && $model->update())  {
            return $this->redirect(["delivery/index"]);
        }

        return $this->renderAjax("update-status", ["model" => $model]);
    }



}