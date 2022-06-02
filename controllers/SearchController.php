<?php

namespace app\controllers;

use app\models\SearchForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SearchController extends Controller
{

    public function actionIndex() {

        $model = new SearchForm();
        $query = $model->search($this->request->queryParams);


        $count = $query->count();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render("index", ["count" => $count, "dataProvider" => $dataProvider]);
    }
}