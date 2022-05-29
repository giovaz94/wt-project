<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProduct */

$this->title = 'Update Available Product: ' . $model->idAvailableProduct;
$this->params['breadcrumbs'][] = ['label' => 'Available Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAvailableProduct, 'url' => ['view', 'idAvailableProduct' => $model->idAvailableProduct]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="available-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
