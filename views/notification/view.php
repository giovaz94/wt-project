<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notification */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <div class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
        <h1 class="cart-sum-title section-list-decor font-section"><?= Html::encode($this->title)?></h1>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idNotification',
            'title',
            [
                    "label" => "Testo",
                    "value" => function($model) {
                        return Html::decode($model->body);
                    },
                    'format' => 'raw'
            ],
            'dateOfCreation',
        ],
    ]) ?>

    <?= Html::a('Torna alle notifiche', ['notification/index'], ['class' => 'btn btn-primary']) ?>

</div>
