<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="available-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAvailableProduct') ?>

    <?= $form->field($model, 'availability') ?>

    <?= $form->field($model, 'sellingPrice') ?>

    <?= $form->field($model, 'refProduct') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
