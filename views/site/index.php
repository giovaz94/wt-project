<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>

<section class="px-3 py-4 bg-color-custom col-lg-auto mb-4 border-bottom">
    <header class="row search-bar-name">
        <div class="container d-flex flex-wrap justify-content-center">
            <h1 class="font-section"> Cerca tra i nostri titoli </h1>
        </div>
    </header>
    <div class="search-container d-flex justify-content-center input-group mb-3">
        <?= Html::beginForm(["search/index"], "get") ?>
        <?= Html::textInput("query", null, ["class" => "search-input-bar", "placeholder" => "Search for a product"]) ?>
        <?= Html::submitButton("<svg class=\"button-svg-search\" role=\"img\"><use xlink:href=\"#search-icon\" /></svg>", ["class" => "search-button"]) ?>
        <?= Html::endForm() ?>
    </div>
</section>

<section class="product-overview">
    <section class="product-overview-new-arrivals">
        <div class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
            <p class="section-list-decor font-section">Nuovi</p>
            <p class="font-section">&nbsp;arrivi</p>
        </div>
        <div class="container container-slider">
            <ul class="control custom-control-1">
                <li class="prev text-center">
                    <em><</em>
                </li>
                <li class="next text-center">
                    <em>></em>
                </li>
            </ul>
            <div class="my-slider">
                <div class="slide new-arrivals">
                    <a class="slide new-arrivals" href="prodotto">
                        <div class="slide-img new-arrivals-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto nuovo"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties new-arrivals-properties">
                            <p class="titolo-libro" style="font-size: 80% !important;">Titolo Libro</p>
                            <p class="prezzo"  style="font-size: 70% !important;">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                            <p class="autore"  style="font-size: 70% !important;">
                                Autore: Pinco Pallo
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide new-arrivals">
                    <a class="slide new-arrivals" href="prodotto">
                        <div class="slide-img new-arrivals-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto nuovo"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties new-arrivals-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide new-arrivals">
                    <a class="slide new-arrivals" href="prodotto">
                        <div class="slide-img new-arrivals-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto nuovo"
                                 src="logo_vector.svg">
                        </div>
                        <div class="slide-properties new-arrivals-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide new-arrivals">
                    <a class="slide new-arrivals" href="prodotto">
                        <div class="slide-img new-arrivals-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto nuovo"
                                 src="logo_vector.svg">
                        </div>
                        <div class="slide-properties new-arrivals-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide new-arrivals">
                    <a class="slide new-arrivals" href="prodotto">
                        <div class="slide-img new-arrivals-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto nuovo"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties new-arrivals-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="product-overview-promo-articles">
        <div class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
            <p class="section-list-decor font-section">Articoli</p>
            <p class="font-section">&nbsp;in promozione</p>
        </div>
        <div class="container container-slider">
            <ul class="control custom-control-2">
                <li class="prev text-center">
                    <em><</em>
                </li>
                <li class="next text-center">
                    <em>></em>
                </li>
            </ul>
            <div class="my-slider">
                <div class="slide promo-articles">
                    <a class="slide promo-articles" href="prodotto">
                        <div class="slide-img promo-articles-img">
                            <img class="product-img product-promo-img"
                                 alt="Immagine del prodotto in promozione"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties promo-articles-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide promo-articles">
                    <a class="slide promo-articles" href="prodotto">
                        <div class="slide-img promo-articles-img">
                            <img class="product-img product-promo-img"
                                 alt="Immagine del prodotto in promozione"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties promo-articles-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide promo-articles">
                    <a class="slide promo-articles" href="prodotto">
                        <div class="slide-img promo-articles-img">
                            <img class="product-img product-promo-img"
                                 alt="Immagine del prodotto in promozione"
                                 src="logo_vector.svg">
                        </div>
                        <div class="slide-properties promo-articles-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide promo-articles">
                    <a class="slide promo-articles" href="prodotto">
                        <div class="slide-img promo-articles-img">
                            <img class="product-img product-promo-img"
                                 alt="Immagine del prodotto in promozione"
                                 src="logo_vector.svg">
                        </div>
                        <div class="slide-properties promo-articles-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide promo-articles">
                    <a class="slide promo-articles" href="prodotto">
                        <div class="slide-img promo-articles-img">
                            <img class="product-img product-promo-img"
                                 alt="Immagine del prodotto in promozione"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties promo-articles-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="product-overview-ebook">
        <div class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
            <p class="section-list-decor font-section">Ebook</p>
        </div>
        <div class="container container-slider">
            <ul class="control custom-control-3">
                <li class="prev text-center">
                    <em><</em>
                </li>
                <li class="next text-center">
                    <em>></em>
                </li>
            </ul>
            <div class="my-slider">
                <div class="slide ebook">
                    <a class="slide ebook" href="prodotto">
                        <div class="slide-img ebook-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto ebook"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties ebook-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide ebook">
                    <a class="slide ebook" href="prodotto">
                        <div class="slide-img ebook-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto ebook"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties ebook-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide ebook">
                    <a class="slide ebook" href="prodotto">
                        <div class="slide-img ebook-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto ebook"
                                 src="logo_vector.svg">
                        </div>
                        <div class="slide-properties ebook-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide ebook">
                    <a class="slide ebook" href="prodotto">
                        <div class="slide-img ebook-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto ebook"
                                 src="logo_vector.svg">
                        </div>
                        <div class="slide-properties ebook-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="slide ebook">
                    <a class="slide ebook" href="prodotto">
                        <div class="slide-img ebook-img">
                            <img class="product-img product-related-img"
                                 alt="Immagine del prodotto ebook"
                                 src="degrado.png">
                        </div>
                        <div class="slide-properties ebook-properties">
                            <p class="titolo-libro">Titolo Libro</p>
                            <p class="autore">
                                Autore: Pinco Pallo
                            </p>
                            <p class="prezzo">
                                <!-- Normal price (if not discounted) --><del><!-- Normal price (if discounted) -->5,00€</del>&ensp;<ins><!-- Discounted price (if discounted) -->2,50€</ins>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</section>



