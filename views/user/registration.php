<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $taxData app\models\TaxData */

$this->title = 'Create User';
?>


<?= $this->render('_form', [
    'user' => $user,
    'taxData' => $taxData
]) ?>

