<?php

namespace app\controllers;

use app\models\AvailableProduct;
use app\models\ResetPasswordForm;
use app\models\TaxData;
use app\models\User;

use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
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
                            'actions' => ['buyer-registration', 'vendor-registration', 'deliver-registration', 'request-password-reset', "reset-password"],
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
        $dataProvider = new ActiveDataProvider([
            'query' => AvailableProduct::find()
                ->joinWith("product")
                ->andWhere(['product.refUser' => Yii::$app->user->id])
        ]);

        return $this->render('view', [
            'model' => $this->findModel(),
            'dataProvider' => $dataProvider,
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

            $model->load($this->request->post());
            $model->validate();

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
     * Register a new deliver.
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionDeliverRegistration()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_DELIVER_REGISTRATION;

        if ($this->request->isPost) {

            $model->load($this->request->post());
            $model->validate();

            if ($model->load($this->request->post()) && $model->save()) {

                $auth = Yii::$app->authManager;
                $deliverRole = $auth->getRole('deliver');
                $auth->assign($deliverRole, $model->getId());

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
        $model->password = "";

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
     * Action for requesting a password reset on the account
     * @return string
     * @throws Exception
     * @throws StaleObjectException
     */
    public function actionRequestPasswordReset() {

        $model = new ResetPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->sendRecovery();
            return $this->render("changing-password-info", ["email" => $model->email]);
        }

        $this->layout = "clear";
        return $this->render("request-recovery", [
            "model" => $model
        ]);
    }

    public function actionResetPassword($idUser, $token) {

        $model = User::findOne(["idUser" => $idUser, "resetKey" => $token]);
        if(!$model) {
            throw new NotFoundHttpException('La pagina richiesta non esiste.');
        }

        $model->scenario = User::SCENARIO_RESET_PASSWORD;
        if($model->load(Yii::$app->request->post()) && $model->update()) {
            $model->resetKey = "";
            $model->update(false);
            return  $this->redirect(["site/index"]);
        }

        $model->password = "";
        $this->layout = "clear";
        return $this->render("reset-password", ["model" => $model]);
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

        throw new NotFoundHttpException('La pagina richiesta non esiste.');
    }
}
