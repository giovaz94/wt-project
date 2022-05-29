<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $taxData app\models\TaxData */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'taxData' => $taxData
    ]) ?>

</div>
