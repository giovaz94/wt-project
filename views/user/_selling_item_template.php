<?php

    /**
     * @var $model \app\models\AvailableProduct
    */

use yii\helpers\Html;

?>


<tr>
    <td>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex justify-content-start">
                <a href="#" class="nav-link text-black-50" aria-label="Immagine">
                    <?= Html::img("@web/uploads/{$model->product->img}", [ "alt" => $model->product->name,  "class" => "product-cart-image bi"]) ?>
                </a>
            </div>
            <div class="row d-flex justify-content-center text-small align-items-center">
                <p>ID Articolo: <?= $model->product->idProduct ?> </p>
                <p class="line-break-custom format-custom">Titolo: <?= $model->product->name?> </p>
                <p class="format-custom">Prezzo originale: <?= $model->product->price?> </p>
                <div>
                    <?= Html::a("Modifica", ["product/update", "idProduct" => $model->product->idProduct]) ?>
                </div>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-start">
            <?= $model->availability ?>
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-start flex-wrap">
            <?= $model->sellingPrice ?> €
        </div>
    </td>
</tr>