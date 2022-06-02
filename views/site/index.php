<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>


<h1> Search for a product </h1>

<?= Html::beginForm(["search/index"], "get"); ?>

<?= Html::textInput("query", null, ["placeholder" => "Search for a product"]) ?>

<?= Html::submitButton() ?>

<?= Html::endForm(); ?>



