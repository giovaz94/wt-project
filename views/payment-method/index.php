<?php

use app\models\PaymentMethod;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentMethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Methods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-method-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payment Method', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPaymentMethod',
            'creditCardNumber',
            'creditCardSecurity',
            'expiringDate',
            'ownerFirstName',
            //'ownerLastName',
            //'refUser',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PaymentMethod $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idPaymentMethod' => $model->idPaymentMethod]);
                 }
            ],
        ],
    ]); ?>


</div>
