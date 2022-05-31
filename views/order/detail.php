<?php

use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;


/**
 * @var Order $model
 * @var ActiveDataProvider $dataProvider
 */

$this->title = "Ordine " . $model->idOrder;
?>

<section>
    <header>
        <h1> <?= Html::encode($this->title) ?></h1>
    </header>

    <table class="table">
        <thead class="text-center">
        <tr>
            <th> Articolo </th> <th> Quantità </th> <th> Totale </th>
        </tr>
        </thead>
        <tbody>
        <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}",
                'itemView' => '_order_item_template',
            ])
        ?>
        </tbody>
    </table>

</section>

