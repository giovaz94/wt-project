<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="available-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'availability')->textInput() ?>

    <?= $form->field($model, 'sellingPrice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
