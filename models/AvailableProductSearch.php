<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvailableProduct;

/**
 * AvailableProductSearch represents the model behind the search form of `app\models\AvailableProduct`.
 */
class AvailableProductSearch extends AvailableProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAvailableProduct', 'availability', 'refProduct'], 'integer'],
            [['sellingPrice'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAvailableProduct' => 'Id Available Product',
            'availability' => 'Disponibilità',
            'refUser' => 'Riferimento utente',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AvailableProduct::find()
            ->joinWith(['product' => function($query) {
                $query->andWhere(['refUser' => \Yii::$app->user->id]);
            }]);
        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idAvailableProduct' => $this->idAvailableProduct,
            'availability' => $this->availability,
            'sellingPrice' => $this->sellingPrice,
            'refProduct' => $this->refProduct,
        ]);

        return $dataProvider;
    }
}
