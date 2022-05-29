<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $taxData app\models\TaxData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'dateOfBirth')->textInput() ?>

    <?= $form->field($user, 'cityOfBirth')->textInput(['maxlength' => true]) ?>

    <?php if(isset($taxData)) : ?>

        <?= $form->field($taxData, 'businessName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($taxData, 'vatNumber')->textInput(['maxlength' => true]) ?>

        <?= $form->field($taxData, 'businessAddress')->textInput(['maxlength' => true]) ?>

        <?= $form->field($taxData, 'businessCity')->textInput(['maxlength' => true]) ?>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
