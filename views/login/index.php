<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login Utente';
?>


<div class="container container-luca">
    <div class="d-flex align-items-center justify-content-center logo-generic-login">
        <a href="<?= Url::toRoute(["site/index"]) ?>">
            <?= Html::img("@web/imgs/logo-campus-book.png", [
                "alt" => "Campus Books",
                "class" => "logo-top-bar responsive"
            ]) ?>
        </a>
    </div>
    <div class="card card-generic-login">
        <div class="card-body">

            <?php $form = ActiveForm::begin(['class' => 'login-form']); ?>

            <fieldset>
                <legend class="user_login">Login utente</legend>
                <label for="LoginForm[username]" hidden>Username</label>
                <?= $form->field($model, 'username')->textInput(["placeholder" => "Username"])->label(false) ?>
                <label for="LoginForm[password]" hidden>Password</label>
                <?= $form->field($model, 'password')->passwordInput(["placeholder" => "Password"])->label(false) ?>

                <button class="btn btn-lg btn-primary" type="submit">Login</button>
                <div class="row link-generic-login">
                    <?= Html::a("Hai dimenticato la password?", ["user/request-password-reset"]) ?>
                    <?= Html::a("Non hai un account? Iscriviti!", ["user/buyer-registration"]) ?>
                    <?= Html::a("Sei un venditore? Crea il tuo negozio!", ["user/vendor-registration"]) ?>
                </div>
            </fieldset>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
