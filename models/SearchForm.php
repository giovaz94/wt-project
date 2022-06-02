<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SearchForm extends Model
{
    public function search($params)
    {
        $query = AvailableProduct::find()->joinWith("product");
        $queryStr = !empty($params["query"]) ? $params["query"] : "";
        $query->andWhere("MATCH(name,description) AGAINST (:query IN NATURAL LANGUAGE MODE)", [":query" => $queryStr]);
        return $query;
    }

}


