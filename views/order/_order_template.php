<?php

use app\models\Order;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Order $model
 */

?>

<tr>
    <td> <?= $model->idOrder?> </td>
    <td> <?= $model->getItemCount() ?></td>
    <td> <?= $model->total ?> </td>
    <td> <?= Yii::$app->formatter->asDate( $model->dateOfCreation, 'php:d-m-Y') ?> </td>
    <td> <?= $model->getStatusLabel() ?></td>
    <td> <?= Html::a("View", ["order/detail", "idOrder" => $model->idOrder ])?></td>
</tr>



