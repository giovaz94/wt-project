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
        <?= Html::img("@web/uploads/{$model->availableProduct->product->img}", [
                "alt" => $model->availableProduct->product->name,
                "class" => "thumb-img"
        ]) ?>
        <div>
            <p> <?= $model->availableProduct->product->name ?> </p>
            <p> Prezzo: <?= $model->availableProduct->sellingPrice ?> €</p>
            <?= Html::a("Rimuovi", ['cart/remove-item', 'idCartItem' => $model->idCartItem])?>
        </div>
    </td>
    <td class="text-center">

        <?= Html::beginForm(Url::to(["cart/edit-quantity", "idCartItem" => $model->idCartItem]), 'post', ["id" => "form-quantity-{$model->idCartItem}"]) ?>
            <?= Html::input("number", "quantity", $model->quantity, ["min" => 1, "id" => "quantity-{$model->idCartItem}"])?>
        <?= Html::endForm() ?>

    </td>
    <td class="text-center"> <?= $model->subtotal ?> </td>
</tr>



