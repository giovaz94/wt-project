<?php

use app\models\Notification;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifiche';
?>

<section class="cart-summary-list-impagination">
    <div class="container-fluid">
        <div
                class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
            <h1 class="cart-sum-title section-list-decor font-section">Notifiche</h1>
        </div>
        <div class="container-fluid py-2 result-padding">
            <div class="col d-flex justify-content-start align-items-center">
                <ul class="nav-nested-item-cart">
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['tag' => null],
                        'layout' => "{items}\n{pager}",
                        'itemView' => '_notification_template',
                        "emptyText" => false
                    ])
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>