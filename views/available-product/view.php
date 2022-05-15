<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProduct */

$this->title = $model->idAvailableProduct;
$this->params['breadcrumbs'][] = ['label' => 'Available Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="available-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idAvailableProduct' => $model->idAvailableProduct], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idAvailableProduct' => $model->idAvailableProduct], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAvailableProduct',
            'availability',
            'sellingPrice',
            'refProduct',
        ],
    ]) ?>

</div>
