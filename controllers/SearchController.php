<?php

namespace app\controllers;

use app\models\SearchForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SearchController extends Controller
{

    public function actionIndex() {

        $model = new SearchForm();
        $dataProvider = $model->search($this->request->queryParams);

        return $this->render("index", ["dataProvider" => $dataProvider]);
    }
}