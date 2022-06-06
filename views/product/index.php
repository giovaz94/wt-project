<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prodotti caricati';
?>

<div class="container-fluid">

    <div class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
        <h1 class="cart-sum-title section-list-decor font-section"><?= Html::encode($this->title)?></h1>
    </div>
    <p>
        <?= Html::a('Crea un prodotto', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout'=> "{items}\n{pager}",
            'columns' => [
                'name',
                [
                        'attribute' => 'price',
                        'value' =>  static function (Product $model) {
                            return $model->price . "€";
                        }
                ],
                'totalPages',
                'author',
                [
                    'attribute' => 'releaseDate',
                    'format' => ['date', 'php:d/m/Y']
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => static function ($action, Product $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'idProduct' => $model->idProduct]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
