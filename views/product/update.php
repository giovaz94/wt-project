<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Update Product: ' . $model->name;
?>
<div class="container external-container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
