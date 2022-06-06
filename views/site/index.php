<?php


use app\models\AvailableProduct;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var AvailableProduct $li
 * @var AvailableProduct $pr
 * @var AvailableProduct $eb
 */

$this->title = 'Campus Book';
?>

<?= $this->render("_search_bar")?>

<div class="container" >
    <section class="product-overview">
        <?php if($li): ?>
        <section class="product-overview-new-arrivals">
            <header class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
                <h1 class="section-list-decor font-section">Nuovi arrivi</h1>
            </header>
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
                    <?php foreach ($li as $ap): ?>
                    <div class="slide new-arrivals">
                        <a class="slide new-arrivals" href="<?= Url::toRoute(["search/detail", "idAvailableProduct" => $ap->idAvailableProduct]) ?>">
                            <div class="slide-img new-arrivals-img">
                                <?= Html::img("@web/uploads/{$ap->product->img}", [
                                    "alt" => $ap->product->name,
                                    "class" => "product-img product-related-img"
                                ]) ?>
                            </div>
                            <div class="slide-properties new-arrivals-properties">
                                <p class="titolo-libro" > <?= $ap->product->name ?></p>
                                <p class="prezzo-libro" >
                                    <?php if($ap->sellingPrice < $ap->product->price): ?>
                                    <del> <?= $ap->product->price ?> €</del>&ensp;<ins><?= $ap->sellingPrice ?> €</ins>
                                    <?php else: ?>
                                        <?= $ap->sellingPrice ?> €
                                    <?php endif; ?>
                                </p>
                                <p class="autore-libro" >
                                    Autore: <?= $ap->product->author ?>
                                </p>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if($pr): ?>
        <section class="product-overview-promo-articles">
            <header class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
                <h1 class="section-list-decor font-section">Articoli in promozione</h1>
            </header>
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
                    <?php foreach ($pr as $ap) : ?>
                        <div class="slide promo-articles">
                            <a class="slide promo-articles" href="<?= Url::toRoute(["search/detail", "idAvailableProduct" => $ap->idAvailableProduct]) ?>">
                                <div class="slide-img promo-articles-img">
                                    <?= Html::img("@web/uploads/{$ap->product->img}", [
                                        "alt" => $ap->product->name,
                                        "class" => "product-img product-related-img"
                                    ]) ?>
                                </div>
                                <div class="slide-properties promo-articles-properties">
                                    <p class="titolo-libro" > <?= $ap->product->name ?></p>
                                    <p class="prezzo-libro" >
                                        <?php if($ap->sellingPrice < $ap->product->price): ?>
                                            <del> <?= $ap->product->price ?> €</del>&ensp;<ins><?= $ap->sellingPrice ?> €</ins>
                                        <?php else: ?>
                                            <?= $ap->sellingPrice ?> €
                                        <?php endif; ?>
                                    </p>
                                    <p class="autore-libro" >
                                        Autore: <?= $ap->product->author ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if($eb): ?>
        <section class="product-overview-ebook">
            <header class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
                <h1 class="section-list-decor font-section">Ebook</h1>
            </header>
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
                    <?php foreach ($eb as $ap) : ?>
                        <div class="slide ebook">
                            <a class="slide ebook" href="<?= Url::toRoute(["search/detail", "idAvailableProduct" => $ap->idAvailableProduct]) ?>">
                                <div class="slide-img ebook-img">
                                    <?= Html::img("@web/uploads/{$ap->product->img}", [
                                        "alt" => $ap->product->name,
                                        "class" => "product-img product-related-img"
                                    ]) ?>
                                </div>
                                <div class="slide-properties ebook-properties">
                                    <p class="titolo-libro" > <?= $ap->product->name ?></p>
                                    <p class="prezzo-libro" >
                                        <?php if($ap->sellingPrice < $ap->product->price): ?>
                                            <del> <?= $ap->product->price ?> €</del>&ensp;<ins><?= $ap->sellingPrice ?> €</ins>
                                        <?php else: ?>
                                            <?= $ap->sellingPrice ?> €
                                        <?php endif; ?>
                                    </p>
                                    <p class="autore-libro" >
                                        Autore: <?= $ap->product->author ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </section>

</div>

<?php
    $this->registerJs("
        const tnsCarousel = document.querySelectorAll('.my-slider');
        let idController = 1;
        tnsCarousel.forEach(slider => {
                const tnsSlider = tns({
                    container: slider,
                    items: 2,
                    slideBy: 'page',
                    nav: false,
                    controlsContainer: '.custom-control' + '-' + idController++,
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
        });
    ");
?>
