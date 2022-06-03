<?php

use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var Order $model
 * @var ActiveDataProvider $dataProvider
 */

$this->title = "Ordine " . $model->idOrder;
?>

<section>

    <div class="container-fluid">
        <div class="home-section-title cart-sum row d-flex justify-content-between align-items-center py-3 my-2">
            <div class="col d-flex justify-content-start align-items-center">
                <h1 class="cart-sum-title section-list-decor font-section">Ordine 12</h1>
            </div>
            <div class="col">
                <p class="cart-sum-title font-section">Stato: <?= $model->getStatusLabel() ?></p>
            </div>
        </div>
        <div class="container-fluid py-2">
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
                            <p class="no-wrap-final-price">Prezzo finale</p>
                        </th>
                    </tr>
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{pager}",
                        'itemView' => '_order_item_template',
                    ])
                    ?>
                </table>
            </div>
        </div>
    </div>
    <section class="order-bar">
        <hr class="horizontal-line">
        <div class="container d-flex align-items-end flex-column px-4 my-4">
            <div class="row">
                <ul class="order-bar-list">
                    <li>
                        <p>Prezzo: <?= $model->total ?> €</p>
                    </li>
                    <li>
                        <p>Spedizione: 5€</p>
                    </li>
                    <li>
                        <p>Totale: <?= $model->total + 5.00 ?> €</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

</section>

