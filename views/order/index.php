<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var ActiveDataProvider $dataProvider
 */

$this->title = "Storico Ordini";
?>

<section>
    <header>
        <h1> <?= Html::encode($this->title)?> </h1>
    </header>

    <table class="table">
        <thead class="text-center">
        <tr>
            <th> ID </th> <th> N° Articoli </th> <th> Totale </th> <th> Data </th> <th> Status </th> <th> Dettagli </th>
        </tr>
        </thead>
        <tbody>
        <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}",
                'itemView' => '_order_template',
            ])
        ?>
        </tbody>
    </table>


</section>



