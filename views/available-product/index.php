<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvailableProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Available Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="available-product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Available Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idAvailableProduct',
            'availability',
            'sellingPrice',
            'refProduct',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idAvailableProduct' => $model->idAvailableProduct]);
                 }
            ],
        ],
    ]); ?>


</div>
