<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentMethod */

$this->title = $model->idPaymentMethod;
$this->params['breadcrumbs'][] = ['label' => 'Payment Methods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payment-method-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idPaymentMethod' => $model->idPaymentMethod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idPaymentMethod' => $model->idPaymentMethod], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPaymentMethod',
            'creditCardNumber',
            'creditCardSecurity',
            'expiringDate',
            'ownerFirstName',
            'ownerLastName',
            'refUser',
        ],
    ]) ?>

</div>
