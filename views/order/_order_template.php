<?php

use app\models\Order;
use yii\web\View;

/**
 * @var View $this
 * @var Order $model
 */

?>

<tr>
    <td> <?= $model->idOrder?> </td>
    <td> <?= $model->getOrderItems()->count() ?></td>
    <td> <?= $model->total ?> </td>
    <td> <?= $model->dateOfCreation ?> </td>
</tr>



