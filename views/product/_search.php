<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idProduct') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'img') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'totalPages') ?>

    <?php // echo $form->field($model, 'releaseDate') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'refProductCategory') ?>

    <?php // echo $form->field($model, 'refProductTypology') ?>

    <?php // echo $form->field($model, 'refUser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
