<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Aggiorna Prodotto: ' . $model->name;
?>
<div class="container external-container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
