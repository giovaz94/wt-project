<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-method-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'creditCardNumber')->textInput() ?>

    <?= $form->field($model, 'creditCardSecureNumber')->textInput() ?>

    <?= $form->field($model, 'creditCardOwnerName')->textInput() ?>

    <?= $form->field($model, 'creditCardOwnerSurname')->textInput() ?>

    <?= $form->field($model, 'expiryDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Checkout', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
