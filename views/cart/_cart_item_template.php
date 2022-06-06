<?php

use app\models\CartItem;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var CartItem $model
 */
?>

<tr>
    <td>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex justify-content-start">
                <?= Html::img("@web/uploads/{$model->availableProduct->product->img}", [
                    "alt" => $model->availableProduct->product->name,
                    "class" => "product-cart-image bi"
                ]) ?>
            </div>
            <div class="row d-flex justify-content-center text-small align-items-center">
                <p class="line-break-custom format-custom"><?= $model->availableProduct->product->name ?></p>
                <p class="format-custom"><?= $model->availableProduct->sellingPrice ?> €</p>
                <?= Html::a("Rimuovi", ['cart/remove-item', 'idCartItem' => $model->idCartItem, 'class' => "btn btn-remove-product text-danger button-boxless"])?>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-start">
            <?= Html::beginForm(Url::to(["cart/edit-quantity", "idCartItem" => $model->idCartItem]), 'post', ["id" => "form-quantity-{$model->idCartItem}"]) ?>
                <?= Html::input("number", "quantity", $model->quantity, [
                        "min" => 1,
                        "class" => "input-quantity-product",
                        "id" => "quantity-{$model->idCartItem}"
                ])?>
            <?= Html::endForm() ?>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-start flex-wrap">
            <?= $model->subtotal ?> €
        </div>
    </td>
</tr>



