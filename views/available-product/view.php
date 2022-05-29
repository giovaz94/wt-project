<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
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
        <?= Html::button('Add to cart', ['value'=>Url::to(['cart/add-item', 'idAvailable' => $model->idAvailableProduct]), 'class' => 'showAjaxModal btn btn-success','id'=>'modalButton']) ?>
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

    <?php
        Modal::begin([
            'id' => 'ajax-modal',
            'size'=>'modal-lg',
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
        ]);

        // Render the view here.
        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

</div>
