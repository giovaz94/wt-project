<?php

namespace app\controllers;

use Yii;
use app\models\TaxData;
use app\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * {@inheritDoc}
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
                            'actions' => ['buyer-registration', 'vendor-registration'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view', 'update'],
                            'roles' => ['@']
                        ]
                    ],
                ],
            ]
        );
    }

    /**
     * Displays a single User model.
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        return $this->render('view', [
            'model' => $this->findModel()
        ]);
    }

    /**
     * Register a new buyer.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionBuyerRegistration()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_BUYER_REGISTRATION;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('buyer');
                $auth->assign($authorRole, $model->getId());

                Yii::$app->user->login($model);

                return $this->redirect(['view']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('registration', [
            'user' => $model,
            'taxData' => null
        ]);
    }

    /**
     * Register a new vendor.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionVendorRegistration()
    {
        $vendor = new User();
        $vendor->scenario = User::SCENARIO_VENDOR_REGISTRATION;

        $taxData = new TaxData();

        if ($this->request->isPost) {
            if ($vendor->load($this->request->post()) && $taxData->load($this->request->post())) {

                $isValid = $vendor->validate() & $taxData->validate();
                if($isValid) {
                    $vendor->save(false);
                    $taxData->save(false);
                    $vendor->link('taxData', $taxData);

                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('vendor');
                    $auth->assign($authorRole, $vendor->getId());

                    Yii::$app->user->login($vendor);

                    return $this->redirect(['view']);
                }
            }
        } else {
            $vendor->loadDefaultValues();
        }

        return $this->render('registration', [
            'user' => $vendor,
            'taxData' => $taxData
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel();
        $model->scenario = User::SCENARIO_UPDATE;

        $taxData =  $model->getTaxData()->one();

        if($this->request->isPost && $model->load($this->request->post())) {
            $isValid = $model->validate();
            if(Yii::$app->user->can('vendor')) {
                if(isset($taxData) && $taxData->load($this->request->post())) {
                    $isValid = $isValid && $taxData->validate();
                } else {
                    $isValid = false;
                }
            }

            if($isValid) {
                $model->save(false);
                if(Yii::$app->user->can('vendor')) {
                    $taxData->save(false);
                }

                return $this->redirect(['view']);
            }
        }

        return $this->render('update', [
            'user' => $model,
            'taxData' => $taxData
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = User::findOne(['idUser' => Yii::$app->user->id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
