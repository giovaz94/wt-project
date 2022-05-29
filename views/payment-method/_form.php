<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-method-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'creditCardNumber')->textInput() ?>

    <?= $form->field($model, 'creditCardSecurity')->textInput() ?>

    <?= $form->field($model, 'expiringDate')->textInput() ?>

    <?= $form->field($model, 'ownerFirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ownerLastName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
