<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $taxData app\models\TaxData */

$this->title = 'Update User: ' . $user->username;
?>

<?= $this->render('_form', [
    'user' => $user,
    'taxData' => $taxData
]) ?>

