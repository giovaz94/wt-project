<?php

/**
 * @var View $this
 * @var Order $model
 */

use app\models\Order;
use yii\helpers\Html;
use yii\web\View;

?>

<tr>
    <td>
        <?= $model->idOrder?>
    </td>
    <td>
        <?= $model->getItemCount() ?>
    </td>
    <td>
        <?= $model->total ?> €
    </td>
    <td>
        <?= Yii::$app->formatter->asDate( $model->dateOfCreation, 'php:d-m-Y') ?>
    </td>
    <td>
        <?= $model->getStatusLabel() ?>
    </td>
    <td>
        <?= Html::a("Modifica Status", ["delivery/update-status", "idOrder" => $model->idOrder], ["class" => "showAjaxModal"])?>
    </td>
</tr>