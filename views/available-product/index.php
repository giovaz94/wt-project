<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvailableProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prodotti in vendita';
?>

<div class="container-fluid">

    <div class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
        <h1 class="cart-sum-title section-list-decor font-section"><?= Html::encode($this->title)?></h1>
    </div>

    <div class="table-responsive" >
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                        'label' => "Nome",
                        'value' => static function($model) {
                            return $model->product->name;
                        }
                ],
                'availability',
                'sellingPrice',
                [
                    'class' => ActionColumn::class,
                    'template' => "{delete}"
                ],
            ],
        ]); ?>

    </div>



</div>
