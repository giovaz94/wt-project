<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableProduct */
/* @var $product app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container-fluid">


    <?php $form = ActiveForm::begin(['id' => 'available-products-form']); ?>

    <?= $form->field($model, 'availability')->input("number") ?>

    <?= $form->field($model, 'sellingPrice')->input("number", ["id" => "selling-price", "step" => "any"]) ?>

    <table class="order-table table keep-full-size">
        <tr class="order-table-header text-white">
            <th scope="col">
                Prezzo prodotto
            </th>
            <th scope="col">
                Prezzo di vendita
            </th>
            <th scope="col">
                Differenza prezzo
            </th>
        </tr>
        <tr>
            <td>
                <?= $product->price ?> €
            </td>
            <td class="a-price"> 0 € </td>
            <td class="perc"></td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
        $this->registerJs("
            $(\"#selling-price\").change(function() {
                if($(this).val() && $(this).val() >= 0) {
                    let originalPrice = {$product->price};
                    let diffPercentage = (($(this).val() - originalPrice) / originalPrice) * 100;
                    $(\".a-price\").html($(this).val() + \" € \");
                    $(\".perc\").html(parseFloat(diffPercentage).toFixed(2) + \" % \");
                }
            });
        ");
    ?>

    <?php ActiveForm::end(); ?>

</div>
