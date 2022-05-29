<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->idUser;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idUser' => $model->idUser], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idUser' => $model->idUser], [
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
            'idUser',
            'firstName',
            'lastName',
            'email:email',
            'username',
            'password',
            'dateOfBirth',
            'cityOfBirth',
            'refTaxData',
        ],
    ]) ?>

</div>
