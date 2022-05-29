<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = "Riepilogo Carrello";

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \yii\web\View $this
 */

$this->registerCss("




");

?>



<?php Pjax::begin(['id' => 'cart']) ?>
    <section>
        <header>
            <h1> <?= Html::encode($this->title)?> </h1>
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
                            'itemView' => '_cart_item_template',
                    ])
                ?>
            </tbody>
        </table>
    </section>

    <?php
    $this->registerJs("  
            $(\"input[name=quantity]\").change(function() {
                let requestUrl = $(this).parent().attr(\"action\");
                $.post( requestUrl, $(this).parent().serialize()).done(function( data ) {
                    $.pjax.reload({container:\"#cart\", timeout: false});
                });
            });
        ");
    ?>

<?php Pjax::end() ?>





