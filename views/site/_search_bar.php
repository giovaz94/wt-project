<?php

use yii\helpers\Html;

?>

<section class="px-3 py-4 bg-color-custom col-lg-auto mb-4 border-bottom">
    <header class="row search-bar-name">
        <div class="container d-flex flex-wrap justify-content-center">
            <h1 class="font-section"> Cerca tra i nostri titoli </h1>
        </div>
    </header>
    <div class="search-container d-flex justify-content-center input-group mb-3">
        <?= Html::beginForm(["search/index"], "get") ?>
        <?= Html::textInput("query", null, ["class" => "search-input-bar", "placeholder" => "Cerca un prodotto"]) ?>
        <?= Html::submitButton("<svg class=\"button-svg-search\" role=\"img\"><use xlink:href=\"#search-icon\" /></svg>", ["class" => "search-button"]) ?>
        <?= Html::endForm() ?>
    </div>
</section>