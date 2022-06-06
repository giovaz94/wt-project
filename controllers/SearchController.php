<?php

namespace app\controllers;

use app\models\AvailableProduct;
use app\models\SearchForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SearchController extends Controller
{
    /**
     * Result action
     * @return string
     */
    public function actionIndex() {

        $model = new SearchForm();
        $query = $model->search($this->request->queryParams);


        $count = $query->count();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render("index", ["count" => $count, "dataProvider" => $dataProvider]);
    }

    /**
     * Retun the detail page of a product
     * @param $idAvailableProduct
     * @return string
     */
    public function actionDetail($idAvailableProduct) {
        $model = $this->findModel($idAvailableProduct);

        // Related products
        $rp = AvailableProduct::find()
            ->joinWith("product")
            ->where("Product.refProductTypology=:typology", [':typology' => $model->product->refProductTypology])
            ->andWhere(['!=', 'idProduct', $model->product->idProduct])
            ->limit(10)
            ->all();

        return $this->render('detail', [
            'model' => $model,
            'rp' => $rp
        ]);
    }

    /**
     * Retun an available product
     * @param $idAvailableProduct
     * @return AvailableProduct
     */
    protected function findModel($idAvailableProduct)
    {
        if (($model = AvailableProduct::findOne(['idAvailableProduct' => $idAvailableProduct])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La pagina richiesta non esiste.');
    }

}