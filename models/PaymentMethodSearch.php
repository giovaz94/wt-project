<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentMethod;

/**
 * PaymentMethodSearch represents the model behind the search form of `app\models\PaymentMethod`.
 */
class PaymentMethodSearch extends PaymentMethod
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPaymentMethod', 'creditCardNumber', 'creditCardSecurity', 'refUser'], 'integer'],
            [['expiringDate', 'ownerFirstName', 'ownerLastName'], 'safe'],
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
        $query = PaymentMethod::find();
        // add conditions that should always apply here
        $query->andWhere(['refUser' => \Yii::$app->user->id]);

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
            'idPaymentMethod' => $this->idPaymentMethod,
            'creditCardNumber' => $this->creditCardNumber,
            'creditCardSecurity' => $this->creditCardSecurity,
            'expiringDate' => $this->expiringDate,
        ]);

        $query->andFilterWhere(['like', 'ownerFirstName', $this->ownerFirstName])
            ->andFilterWhere(['like', 'ownerLastName', $this->ownerLastName]);

        return $dataProvider;
    }
}
