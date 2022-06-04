<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProduct */
/* @var $product app\models\Product */

$this->title = 'Vendi';
?>
<div class="available-product-create">

    <div class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
        <h1 class="cart-sum-title section-list-decor font-section"><?= Html::encode($this->title)?></h1>
    </div>

    <?= $this->render('_form', ['model' => $model, 'product' => $product]) ?>

</div>
