<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notification */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
            'body:ntext',
            'dateOfCreation',
        ],
    ]) ?>

    <?= Html::a('Torna alle notifiche', ['notification/index'], ['class' => 'btn btn-primary']) ?>

</div>
