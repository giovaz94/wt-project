<?php

namespace app\controllers;

use app\models\AvailableProduct;
use app\models\AvailableProductSearch;
use app\models\Product;

use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * AvailableProductController implements the CRUD actions for AvailableProduct model.
 */
class AvailableProductController extends Controller
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
                            'roles' => ['addAvailableProduct'],
                            'roleParams' => ['productId' => Yii::$app->request->get('idProduct')],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AvailableProduct models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AvailableProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AvailableProduct model.
     * @param int $idAvailableProduct Id Available Product
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idAvailableProduct)
    {
        return $this->render('view', [
            'model' => $this->findModel($idAvailableProduct),
        ]);
    }

    /**
     * Creates a new AvailableProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate($idProduct)
    {
        $model = new AvailableProduct();
        $product = Product::findOne($idProduct);

        if(!$product) {
            throw new NotFoundHttpException("The requested page does not exist.");
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if(empty($model->sellingPrice)) {
                    $model->sellingPrice = $product->price;
                }
                $model->save(false);
                $model->link('product', $product);

                return $this->redirect(["product/view", "idProduct" => $product->idProduct]);
            }
        } else {
            $model->loadDefaultValues();
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'product' => $product
            ]);
        }

        return $this->render('create', [
            'model' => $model,
            'product' => $product
        ]);
    }

    /**
     * Finds the AvailableProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idAvailableProduct Id Available Product
     * @return AvailableProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idAvailableProduct)
    {
        if (($model = AvailableProduct::findOne(['idAvailableProduct' => $idAvailableProduct])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
