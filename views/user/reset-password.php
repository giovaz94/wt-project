<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/**
 * @var $model \app\models\User
 */

$this->title = "Modifica la password";
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
                <legend class="user_login"><?=  Html::encode($this->title) ?> </legend>
                <label for="ResetPasswordForm[password]" hidden>Password</label>
                <?= $form->field($model, 'password')->passwordInput(["placeholder" => "Nuova password"])->label(false) ?>
                <label for="ResetPasswordForm[password]" hidden>Ripeti Password</label>
                <?= $form->field($model, 'password_repeat')->passwordInput(["placeholder" => "Ripeti password"])->label(false) ?>
                <?= Html::submitButton('Modifica la password', ['class' => 'btn btn-success']) ?>
            </fieldset>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

