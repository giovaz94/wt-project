<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idProduct' => $model->idProduct], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idProduct' => $model->idProduct], [
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
            'idProduct',
            'name',
            'description:ntext',
            'img',
            'price',
            'totalPages',
            'releaseDate',
            'author',
            'refProductCategory',
            'refProductTypology',
            'refUser',
        ],
    ]) ?>

</div>
