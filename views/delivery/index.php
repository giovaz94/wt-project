<?php

use app\assets\ModalAsset;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = "Gestione Ordini";

ModalAsset::register($this);
?>

<section class="cart-summary-list-impagination">
    <div class="container-fluid">
        <div class="home-section-title d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
            <h1 class="section-list-decor font-section"><?= Html::encode($this->title)?></h1>
        </div>
        <div class="container-fluid py-2">
            <div class="table-responsive">
                <table class="order-table table font-additional-modification">
                    <tr class="order-table-header text-white">
                        <th scope="col">
                            <div>
                                <p>ID</p>
                            </div>
                        </th>
                        <th scope="col">
                            <p>N Articoli</p>
                        </th>
                        <th scope="col">
                            <p class="no-wrap-final-price">Totale</p>
                        </th>
                        <th scope="col">
                            <p class="no-wrap-final-price">Data</p>
                        </th>
                        <th scope="col">
                            <p class="no-wrap-final-price">Status</p>
                        </th>
                        <th scope="col">
                            <p class="no-wrap-final-price">Dettaglio</p>
                        </th>
                    </tr>
                    <?=
                        ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{items}\n{pager}",
                            'itemView' => '_template_order_info',
                        ])
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
Modal::begin([
    'id' => 'ajax-modal',
    'size'=>'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

echo "<div id='modalContent'></div>";

Modal::end();
?>
