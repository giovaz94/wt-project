<?php

/**
 * @var AvailableProduct $model
 */

use app\models\AvailableProduct;
use yii\helpers\Html;

?>

<li>
    <div class="d-flex justify-content-start my-4">
        <div class="col-sm-3">
            <a href="/" class="text-white">
                <?= Html::img("@web/uploads/{$model->product->img}", [
                    "alt" => $model->product->name,
                    "class" => "product-search-result-image bi"
                ]) ?>
            </a>
        </div>
        <div class="col-sm-8 vertical-align-top px-4">
            <p class="format-custom titolo-libro"><?= $model->product->name?></p>
            <p class="format-custom"><?= $model->sellingPrice?> €</p>
            <p class="format-custom"><?= $model->product->description ?>
            </p>
            <?= Html::a("Dettagli", ["search/detail", "idAvailableProduct" => $model->idAvailableProduct], ["class" => "btn btn-lg btn-primary btn-block"])?>

        </div>
    </div>
</li>