<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <svg xmlns="http://www.w3.org/2000/svg" display="none">
        <symbol class="bi bi-person-circle" id="profile" viewBox="0 0 16 16" fill="currentColor">
            <title>Profilo</title>
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol class="bi bi-bell" id="bell" viewBox="0 0 16 16" fill="currentColor">
            <title>Notifiche</title>
            <path
                    d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
        </symbol>
        <symbol class="bi bi-cart" id="cart" viewBox="0 0 16 16" fill="currentColor">
            <title>Carrello</title>
            <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
        <symbol fill="currentColor" id="search-icon" class="bi bi-search" viewBox="0 0 16 16">
            <title>Cerca</title>
            <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </symbol>
        <symbol fill="currentColor" id="left-arrow-icon" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
            <title>Freccia a sinistra</title>
            <path
                    d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
        </symbol>
        <symbol fill="currentColor" id="right-arrow-icon" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
            <title>Freccia a sinistra</title>
            <path
                    d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
        </symbol>
    </svg>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg order-bottom-header">
    <div class="container-fluid">
        <a href="<?= Url::toRoute(["site/index"]) ?>" class="navbar-brand">
            <?= Html::img("@web/imgs/logo-campus-book.png", [
                "alt" => "Campus Books",
                "class" => "logo-top-bar responsive"
            ]) ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="btn btn-dropdown dropdown-toggle nav-link text-black-50" id="dropdown-menu-header" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg class="bi button-svg d-block mx-auto mb-1" role="img">
                            <use xlink:href="#profile" />
                        </svg>
                        Profilo
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-menu-header">
                        <?php if(!Yii::$app->user->isGuest) : ?>
                        <li><a href="<?= Url::to(["order/index"])?>" class="dropdown-item">Ordini</a></li>
                        <li><a href="<?= Url::to(["user/view"])?>" class="dropdown-item">Area utente</a></li>
                        <?php if(Yii::$app->user->can("vendor") ) : ?>
                        <li><a href="<?= Url::to(["product/index"])?>" class="dropdown-item">Prodotti caricati</a></li>
                        <li><a href="<?= Url::to(["available-product/index"])?>" class="dropdown-item">Prodotti in vendita</a></li>
                        <li><a href="<?= Url::to(["product/create"])?>" class="dropdown-item">Inserisci prodotto</a></li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><?= Html::a('Log out', Url::to(['login/logout']), ["class" => "dropdown-item" ,'data-method' => 'POST']) ?></li>
                        <?php else: ?>
                        <li><a href="<?= Url::toRoute(["login/index"])?>" class="dropdown-item">Accedi</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::toRoute(["notification/index"])?> "class="nav-link text-center text-black-50">
                        <svg class="bi button-svg d-block mx-auto mb-1" role="img">
                            <use xlink:href="#bell" />
                        </svg>
                        Notifiche
                    </a>
                </li>
                <li>
                    <a href="<?= Url::toRoute(["cart/index"])?>" class="nav-link text-center text-black-50">
                        <svg class="bi button-svg d-block mx-auto mb-1" role="img">
                            <use xlink:href="#cart" />
                        </svg>
                        Carrello
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<main>
    <?= $content ?>
</main>

<div class="container-fluid footer-container">
    <footer class="d-flex flex-wrap justify-content-around align-items-center py-3 my-4 border-top">
        <ul class="nav nav-footer col-md-4 justify-content-start">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">
                    <p class="footer-list-decor">Link</p>
                </a>
                <ul class="nav-nested-item-footer justify-content-start">
                    <li><a href="<?= Url::to(["site/index"])?>" class="nav-link px-2 text-black">Home</a></li>
                    <li><a href="<?= Url::to(["notification/index"])?>" class="nav-link px-2 text-black">Notifiche</a></li>
                    <li><a href="<?= Url::to(["cart/index"])?>" class="nav-link px-2 text-black">Carrello</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">
                    <p class="footer-list-decor">Social</p>
                </a>
                <ul class="nav-nested-item-footer justify-content-start">
                    <li><a href="#" class="nav-link px-2 text-black">Github</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">Facebook</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">Linkedin</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">
                    <p class="footer-list-decor">Info</p>
                </a>
                <ul class="nav-nested-item-footer justify-content-start">
                    <li><a href="#" class="nav-link px-2 text-black">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">About</a></li>
                </ul>
            </li>
        </ul>

        <div class="col-md-4 d-flex flex-column-reverse align-items-end me-sm-1">
            <div class="mb-0">
                <p class="copyright text-muted">&copy; 2022 Company, Inc</p>
            </div>
            <div class="d-flex align-items-center mb-3 mb-md-0">

                <a href="<?= Url::toRoute(["site/index"]) ?>" class="link-dark">
                    <?= Html::img("@web/imgs/logo-campus-book.png", [
                        "alt" => "Campus Books",
                        "class" => "logo-top-bar responsive bi me-2"
                    ]) ?>
                </a>
            </div>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
