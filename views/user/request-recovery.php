<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model \app\models\ResetPasswordForm
 */

$this->title = "Reset Password";
?>

<h1> <?= Html::encode($this->title)?> </h1>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Recupera', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

