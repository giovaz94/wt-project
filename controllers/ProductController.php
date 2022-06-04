<?php

namespace app\controllers;

use app\models\AvailableProduct;
use app\models\Product;
use app\models\ProductSearch;
use app\models\User;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                            'roles' => ['vendor']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['addProduct']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewProduct'],
                            'roleParams' => ['productId' => Yii::$app->request->get('idProduct')],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['editProduct'],
                            'roleParams' => ['productId' => Yii::$app->request->get('idProduct')],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['removeProduct'],
                            'roleParams' => ['productId' => Yii::$app->request->get('idProduct')],
                        ],
                    ],
                ],
            ]
        );
    }


    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $idProduct Id Product
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idProduct)
    {
        return $this->render('view', [
            'model' => $this->findModel($idProduct),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws StaleObjectException
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = $model->uploadImage();
            if($model->save()) {
                $model->link("user", User::findOne(Yii::$app->user->id));
                if ($image !== false) {
                    $path = $model->getImageUrl();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'idProduct' => $model->idProduct]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [ 'model' => $model ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idProduct Id Product
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException|Exception
     */
    public function actionUpdate($idProduct)
    {
        $model = $this->findModel($idProduct);
        $oldImgUrl = $model->getImageUrl();
        $oldImgName = $model->img;

        if ($model->load(Yii::$app->request->post())) {
            $image = $model->uploadImage();
            if($image === false) {
                $model->img = $oldImgName;
            }

            if ($model->save()) {
                if ($image !== false && unlink($oldImgUrl)) {
                    $path = $model->getImageUrl();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'idProduct' => $model->idProduct]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idProduct Id Product
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws ServerErrorHttpException
     */
    public function actionDelete($idProduct)
    {
        $model = $this->findModel($idProduct);
        if($model->delete() && !$model->deleteImage()) {
            throw new ServerErrorHttpException("An error occurred during the elimination of an image");
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idProduct Id Product
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idProduct)
    {
        if (($model = Product::findOne(['idProduct' => $idProduct])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
