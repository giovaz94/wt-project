<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProduct */

$this->title = 'Create Available Product';
$this->params['breadcrumbs'][] = ['label' => 'Available Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="available-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
