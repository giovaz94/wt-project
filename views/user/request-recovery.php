<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model \app\models\ResetPasswordForm
 */

$this->title = "Recupero password";
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

            <?php $form = ActiveForm::begin(['class' => 'login-form']); ?>

            <fieldset>
                <legend class="user_login"><?=  Html::encode($this->title) ?> </legend>
                <label for="ResetPasswordForm[email]" hidden>Email</label>
                <?= $form->field($model, 'email')->textInput(["placeholder" => "Inserisci la tua mail"])->label(false) ?>
                <?= Html::submitButton('Recupera', ['class' => 'btn btn-success']) ?>
            </fieldset>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


