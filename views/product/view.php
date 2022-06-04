<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container external-container">

    <div class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
        <h1 class="cart-sum-title section-list-decor font-section"><?= Html::encode($this->title)?></h1>
    </div>

    <p>
        <?= Html::a('Modifica il prodotto', ['update', 'idProduct' => $model->idProduct], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina il prodotto', ['delete', 'idProduct' => $model->idProduct], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::button('Vendi il prodotto', ['value'=> Url::to(['available-product/create', 'idProduct' => $model->idProduct]), 'class' => 'showAjaxModal btn btn-success','id'=>'modalButton']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProduct',
            'name',
            'description:ntext',
            'price',
            'totalPages',
            'releaseDate',
            'author',
            'refProductCategory',
            'refProductTypology',
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
