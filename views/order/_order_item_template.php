<?php
use app\models\Order;
use app\models\OrderItem;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var View $this
 * @var OrderItem $model
 */


?>

<td>
    <?= Html::img("@web/uploads/{$model->img}", [
        "alt" => $model->name,
        "class" => "thumb-img"
    ]) ?>
    <div>
        <p> <?= $model->name ?> </p>
        <p> Prezzo: <?= $model->unitPrice ?> €</p>
    </div>
</td>
<td class="text-center">
    <?= $model->quantity ?>
</td>
<td class="text-center"> <?= $model->subtotal ?> </td>
