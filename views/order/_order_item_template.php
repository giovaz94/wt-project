<?php

use app\models\OrderItem;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var View $this
 * @var OrderItem $model
 */
?>

<tr>
    <td>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex justify-content-start">
                    <?= Html::img("@web/uploads/{$model->img}", [
                        "alt" => $model->name,
                        "class" => "product-cart-image bi"
                    ]) ?>
            </div>
            <div class="row d-flex justify-content-center text-small vertical-align-top">
                <p><?= $model->unitPrice ?> €</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-center">
            <p><?= $model->quantity ?></p>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-start flex-wrap">
            <?= $model->subtotal ?> €
        </div>
    </td>
</tr>
