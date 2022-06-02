<?php

/**
 * @var AvailableProduct $model
 */

use app\models\AvailableProduct;
use yii\helpers\Html;

?>


<li>
    <div class="d-flex justify-content-start">
        <div class="col-sm-3">
            <a href="/" class="text-white">
                <?= Html::img("@web/uploads/{$model->product->img}", [
                    "alt" => $model->product->name,
                    "class" => "product-search-result-image bi"
                ]) ?>
            </a>
        </div>
        <div class="col-sm-8 vertical-align-top px-4">
            <p class="line-break-custom format-custom"><?= $model->product->name?></p>
            <p class="line-break-custom format-custom"><?= $model->sellingPrice?> €</p>
            <p class="line-break-custom format-custom"> <?= $model->product->description ?></p>

            <form class="detail-bar-form mb-3 row-cols-lg-auto g-3 align-items-center"
                  id="detail-form-button">
                <div class="col-12">
                    <button type="button" class="btn btn-danger text-white text-small me-1"
                            aria-label="Bottone per vedere piú dettagli">Dettagli</button>
                </div>
            </form>
        </div>
    </div>
</li>
