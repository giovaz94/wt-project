<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $dataProvider ActiveDataProvider */

$this->title = "Account di $model->username";
?>

<div class="container external-container">
    <h1 class="titolo-pagina"> Informazioni </h1>
    <section class="dati-area-utente">
        <h2 class="titolo-dati-utente">Dati anagrafici</h2>
        <ul class="lista-dati-utente lista-dati-anagrafici-area-utente">
            <li>
                Nome: <?= $model->firstName ?>
            </li>
            <div class="separator"></div>
            <li>
                Cognome: <?= $model->lastName ?>
            </li>
            <div class="separator"></div>
            <li>
                Data di nascita: <?= Yii::$app->formatter->asDate($model->dateOfBirth, "php: d/m/Y") ?>
            </li>
        </ul>
        <div class="separator-section-liste"></div>
        <h2 class="titolo-dati-utente">Account</h2>
        <ul class="lista-dati-utente lista-account-venditore-area-utente">
            <li>
                Username: <?= $model->username ?>
            </li>
            <li>
                E-mail: <?= $model->email ?>
            </li>
        </ul>

        <?php if(Yii::$app->user->can("vendor")) : ?>
        <div class="separator-section-liste"></div>
        <h2 class="titolo-dati-utente">Dati Attività</h2>
        <ul class="lista-dati-utente lista-dati-venditore-area-utente">
            <li>
                Nome Attività: <?= $model->taxData->businessName ?>
            </li>
            <div class="separator"></div>
            <li>
                Partita iva: <?= $model->taxData->vatNumber ?>
            </li>
            <div class="separator"></div>
            <li>
                Indirizzo: <?= $model->taxData->businessAddress ?>
            </li>
            <div class="separator"></div>
            <li>
                Città: <?= $model->taxData->businessCity ?>
            </li>
        </ul>
        <div class="separator-button"></div>
        <?php endif; ?>

        <?= Html::a("Modifica", ["user/update"], ["class" => "btn btn-lg btn-primary btn-block"]) ?>
    </section>

    <?php if(Yii::$app->user->can("vendor")) : ?>
    <div class="separator-section"></div>
    <section class="prodotti-inseriti-venditore">
        <h2 class="titolo-sezione">Prodotti in vendita</h2>
        <div class="table-responsive">
            <table class="order-table table keep-full-size">
                <tr class="order-table-header text-white">
                    <th scope="col">
                        <div class="d-flex justify-content-center">
                            Articolo
                        </div>
                    </th>
                    <th scope="col">
                        Quantitá
                    </th>
                    <th scope="col">
                        <p class="no-wrap-final-price">Prezzo di vendita</p>
                    </th>
                </tr>
                <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{pager}",
                        'itemView' => '_selling_item_template',
                        "emptyText" => false
                    ])
                ?>
            </table>
        </div>
    </section>
    <?php endif; ?>

</div>
