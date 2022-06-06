<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $taxData app\models\TaxData */
/* @var $form yii\bootstrap5\ActiveForm */

?>

<div class="container container-luca">
    <?php $form = ActiveForm::begin(["class" => "need-validation"]); ?>
    <form class="need-validation">
        <fieldset class="account">
            <legend class="form">Account</legend>
            <div class="row">
                <div id="dati-account-email" class="form dati-account col-sm-3">
                    <?= $form->field($user, 'username')->textInput(['class'=> 'form-control', 'maxlength' => true]) ?>
                </div>
                <div id="dati-account-email" class="form dati-account col-sm-3">
                    <?= $form->field($user, 'email')->textInput(['class'=> 'form-control', 'maxlength' => true]) ?>
                </div>
                <div id="dati-account-password" class="form dati-account col-sm-3">
                    <?= $form->field($user, 'password')->passwordInput(['class'=> 'form-control', 'maxlength' => true]) ?>
                </div>
                <div id="dati-account-ripeti-password" class="form dati-account col-sm-3">
                    <?= $form->field($user, 'password_repeat')->passwordInput(['class'=> 'form-control', 'maxlength' => true]) ?>
                </div>
            </div>
        </fieldset>
        <hr>
        <fieldset class="dati-anagrafici">
            <legend class="form">Dati anagrafici</legend>
            <div class="row">
                <div id="dati-anagrafici-nome" class="form dati-anagrafici col-sm-7 col-lg-5">
                    <?= $form->field($user, 'firstName')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                </div>
                <div class="separator"></div>
                <div id="dati-anagrafici-cognome" class="form dati-anagrafici col-sm-7 col-lg-5">
                    <?= $form->field($user, 'lastName')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                </div>
                <div class="separator"></div>
                <div id="dati-anagrafici-dob" class="form dati-anagrafici col-sm-7 col-lg-5">
                    <?= $form->field($user, 'dateOfBirth')->input('date', ['class' => "form-control"]) ?>
                </div>
                <div class="separator"></div>
                <div id="dati-anagrafici-pob" class="form dati-anagrafici col-sm-7 col-lg-5">
                    <?= $form->field($user, 'cityOfBirth')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                </div>
            </div>
        </fieldset>
        <hr>

        <?php if(isset($taxData)) : ?>

            <fieldset class="seller">
                <legend class="form">Dati attività</legend>
                <div class="row">
                    <div id="dati-venditore-cf" class="form dati-venditore col-sm-7 col-lg-5">
                        <?= $form->field($taxData, 'businessName')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                    </div>
                    <div class="separator"></div>
                    <div id="dati-venditore-piva" class="form dati-venditore col-sm-7 col-lg-5">
                        <?= $form->field($taxData, 'vatNumber')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                    </div>
                    <div class="separator"></div>
                    <div id="dati-venditore-indirizzo" class="form dati-venditore col-sm-7 col-lg-5">
                        <?= $form->field($taxData, 'businessAddress')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                    </div>
                    <div class="separator"></div>
                    <div id="dati-venditore-citta" class="form dati-venditore col-sm-7 col-lg-5">
                        <?= $form->field($taxData, 'businessCity')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
                    </div>
                </div>
            </fieldset>

        <?php endif; ?>

        <div class="container text-center">
            <?= Html::submitButton('Invia', ['class' => 'btn btn-lg btn-primary btn-block']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
