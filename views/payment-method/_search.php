<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethodSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-method-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPaymentMethod') ?>

    <?= $form->field($model, 'creditCardNumber') ?>

    <?= $form->field($model, 'creditCardSecurity') ?>

    <?= $form->field($model, 'expiringDate') ?>

    <?= $form->field($model, 'ownerFirstName') ?>

    <?php // echo $form->field($model, 'ownerLastName') ?>

    <?php // echo $form->field($model, 'refUser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
