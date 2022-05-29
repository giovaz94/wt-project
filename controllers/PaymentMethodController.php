<?php

namespace app\controllers;

use app\models\PaymentMethod;
use app\models\PaymentMethodSearch;
use app\models\User;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PaymentMethodController extends Controller
{
    /**
     * @inheritDoc
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
                            'actions' => ['index'],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['addPaymentMethod']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewPaymentMethod'],
                            'roleParams' => ['paymentMethodId' => Yii::$app->request->get('idPaymentMethod')],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['editPaymentMethod'],
                            'roleParams' => ['paymentMethodId' => Yii::$app->request->get('idPaymentMethod')],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['removePaymentMethod'],
                            'roleParams' => ['paymentMethodId' => Yii::$app->request->get('idPaymentMethod')],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PaymentMethod models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PaymentMethodSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentMethod model.
     * @param int $idPaymentMethod Id Payment Method
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idPaymentMethod)
    {
        return $this->render('view', [
            'model' => $this->findModel($idPaymentMethod),
        ]);
    }

    /**
     * Creates a new PaymentMethod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PaymentMethod();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->link('user', User::findOne(Yii::$app->user->id));
                $model->save(false);
                return $this->redirect(['view', 'idPaymentMethod' => $model->idPaymentMethod]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentMethod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idPaymentMethod Id Payment Method
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idPaymentMethod)
    {
        $model = $this->findModel($idPaymentMethod);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPaymentMethod' => $model->idPaymentMethod]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PaymentMethod model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idPaymentMethod Id Payment Method
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idPaymentMethod)
    {
        $this->findModel($idPaymentMethod)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentMethod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idPaymentMethod Id Payment Method
     * @return PaymentMethod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idPaymentMethod)
    {
        if (($model = PaymentMethod::findOne(['idPaymentMethod' => $idPaymentMethod])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
