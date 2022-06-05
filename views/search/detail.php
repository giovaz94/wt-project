<?php

use app\models\AvailableProduct;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var AvailableProduct $model
 * @var AvailableProduct[] $rp
 */

$this->title = $model->product->name;
?>

<div class="container external-container">
    <section class="product-header">
        <div class="container external-container">
            <div class="row justify-content-between product-detail">
                <div class="col-md-5 col-auto image-product">
                    <?= Html::img("@web/uploads/{$model->product->img}", [ "alt" => $model->product->name,  "class" => "product-img"]) ?>
                </div>
                <div class="col-md-7 col-auto header-product">
                    <h1 class="titolo-libro"><?= $model->product->name ?> </h1>
                    <p class="autore-libro">Autore: <?= $model->product->author ?> </p>
                    <p class="prezzo-libro">
                        <?php if($model->sellingPrice < $model->product->price): ?>
                            <del> <?= $model->product->price ?> €</del>&ensp;<ins><?= $model->sellingPrice ?> €</ins>
                        <?php else: ?>
                            <?= $model->sellingPrice ?> €
                        <?php endif; ?>
                    </p>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <?= Html::a("Aggiungi al carrello", ["cart/add-to-cart", "idAvailableProduct" => $model->idAvailableProduct], ["class" => "btn btn-lg btn-primary btn-block"]) ?>
                    <?php else : ?>
                        <p> Effettua il login per aggiungere il prodotto al carrello </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="product-description">
        <h2 class="titolo-sezione">Descrizione</h2>
        <p class="product-description"> <?= $model->product->description ?> </p>
    </section>
    <hr>
    <section class="product-information">
        <h2 class="titolo-sezione">Informazioni</h2>
        <table class="product-information">
            <tbody>
                <tr>
                    <th id="numero-pagine" scope="row">Numero di pagine</th>
                    <td headers="numero-pagine"><?= $model->product->totalPages ?></td>
                </tr>
                <tr class="spacer"></tr>
                <tr>
                    <th id="anno-pubblicazione" scope="row">Data pubblicazione</th>
                    <td headers="anno-pubblicazione"><?= Yii::$app->formatter->asDate($model->product->publication, "php:d-m-Y") ?></td>
                </tr>
                <tr class="spacer"></tr>
                <tr>
                    <th id="tipologia" scope="row">Tipologia</th>
                    <td headers="tipologia"> <?= $model->product->typology->name ?> </td>
                </tr>
                <tr class="spacer"></tr>
                <tr>
                    <th id="Categoria" scope="row">Categoria</th>
                    <td headers="Categoria"> <?= $model->product->category->name ?> </td>
                </tr>
            </tbody>
        </table>
    </section>
    <hr>

    <?php if(!empty($rp)): ?>
    <section class="product-related-articles">
        <h2 class="titolo-sezione">Articoli simili</h2>
        <div class="container container-slider">
            <ul class="control" id="custom-control">
                <li class="prev text-center">
                    <em>&#60;</em>
                </li>
                <li class="next text-center">
                    <em>&#62;</em>
                </li>
            </ul>
            <div class="my-slider">
            <?php foreach ($rp as $ap) : ?>
                <div class="slide related-articles">
                    <a class="slide related-articles" href="<?= Url::toRoute(["search/detail", "idAvailableProduct" => $ap->idAvailableProduct]) ?>">
                        <div class="slide-img related-articles-img">
                            <?= Html::img("@web/uploads/{$ap->product->img}", [
                                "alt" => $ap->product->name,
                                "class" => "product-img product-related-img"
                            ]) ?>
                        </div>
                        <div class="slide-properties related-articles-properties">
                            <p class="titolo-libro" > <?= $ap->product->name ?></p>
                            <p class="autore-libro" >
                                Autore: <?= $ap->product->author ?>
                            </p>
                            <p class="prezzo-libro" >
                                <?php if($ap->sellingPrice < $ap->product->price): ?>
                                    <del> <?= $ap->product->price ?> €</del>&ensp;<ins><?= $ap->sellingPrice ?> €</ins>
                                <?php else: ?>
                                    <?= $ap->sellingPrice ?> €
                                <?php endif; ?>
                            </p>

                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
        $this->registerJS("$(function() {
                var slider = tns({
                    container: '.my-slider',
                    items: 2,
                    slideBy: 'page',
                    nav: false,
                    controlsContainer: '#custom-control',
                    responsive: {
                    576: {
                        edgePadding: 20,
                        gutter: 20
                    },
                    768: {
                        gutter: 30
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                    }
                });
            });");
    ?>

    <?php endif; ?>
</div>


