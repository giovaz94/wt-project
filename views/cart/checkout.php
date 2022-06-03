<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethod */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Pagamento";
?>

<div class="container container-luca">
    <div class="d-flex align-items-center justify-content-center logo-generic-login">
        <a href="/">
            <img class="logo-top-bar responsive" id="logosvgheader"
                 alt="Un libro aperto con qualche pagina svolazzante" title="Logo del sito"
                 src="degrado.png" aria-label="Profilo">
        </a>
    </div>
    <div class="card card-generic-login">

        <div class="card-body">
            <div class="form-container">
                <?php $form = ActiveForm::begin(['class' => 'login-form']); ?>

                <fieldset>
                    <legend class="user_login"> <?= Html::encode($this->title) ?> </legend>

                    <?= $form->field($model, 'creditCardNumber')->textInput() ?>

                    <?= $form->field($model, 'creditCardSecureNumber')->textInput() ?>

                    <?= $form->field($model, 'creditCardOwnerName')->textInput() ?>

                    <?= $form->field($model, 'creditCardOwnerSurname')->textInput() ?>

                    <?= $form->field($model, 'expiryDate')->input('date') ?>

                    <?= Html::submitButton('Checkout', ['class' => 'btn btn-success']) ?>

                </fieldset>

                <?php ActiveForm::end(); ?>
            </div>
        </div>


    </div>
</div>
