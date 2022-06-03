<?php

use app\models\AddToCartForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AddToCartForm */
/* @var $form yii\widgets\ActiveForm */


$hiddenInputFieldName = get_class($model) == AddToCartForm::class ? 'idAvailable' : 'idCartItem';
?>

<div class="add-to-cart-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'create-product-form']]); ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, $hiddenInputFieldName)->hiddenInput(['value'=> $model->{$hiddenInputFieldName}])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
