<?php

use app\models\Cart;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = "Riepilogo Carrello";

/**
 * @var ActiveDataProvider $dataProvider
 * @var View $this
 * @var Cart $cart
 */

$price = $cart->total;
$tax = 5.00;
$total = $price + $tax;

?>



<?php if($cart->getCartItems()->count()): ?>

<?php Pjax::begin(['id' => 'cart-pjax-container']) ?>

<section class="cart-summary-list-impagination">
    <div class="container-fluid">
        <div class="home-section-title cart-sum d-flex flex-wrap justify-content-start align-items-center d-inline py-3 my-2">
            <h1 class="cart-sum-title section-list-decor font-section"><?= Html::encode($this->title)?></h1>
        </div>
        <div class="container-fluid py-2">
            <div class="table-responsive">
                <table class="order-table table keep-full-size">
                    <tr class="order-table-header text-white">
                        <th scope="col">
                            <div class="d-flex">
                                Articolo
                            </div>
                        </th>
                        <th scope="col">
                            Quantitá
                        </th>
                        <th scope="col">
                            <p class="no-wrap-final-price">Prezzo finale</p>
                        </th>
                    </tr>
                        <?=
                            ListView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => "{items}\n{pager}",
                                'itemView' => '_cart_item_template',
                                "emptyText" => false
                            ])
                        ?>
                </table>
            </div>
        </div>
    </div>
</section>
<section class="order-bar">
    <div class="order-bar-div">
        <hr class="horizontal-line">
        <div class="container d-flex align-items-end flex-column px-4 my-4">
            <div class="row">
                <ul class="order-bar-list">
                    <li>
                        <p>Prezzo: <?= $price ?> €</p>
                    </li>
                    <li>
                        <p>Spedizione: <?= $tax ?> €</p>
                    </li>
                    <li>
                        <p>Totale: <?= $total ?> €</p>
                    </li>
                </ul>
            </div>
            <div class="row">
                <form class="order-bar-form mb-3 row-cols-lg-auto g-3 align-items-center"
                      id="purchase-form-button">
                    <div class="col-12">
                        <?= Html::a("Acquista", ["cart/checkout"], ["class" => "btn btn-lg btn-primary btn-block"])?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    $this->registerJs("  
            $(\"input[name=quantity]\").change(function() {
                let requestUrl = $(this).parent().attr(\"action\");
                $.post( requestUrl, $(this).parent().serialize()).done(function( data ) {
                    $.pjax.reload({container:\"#cart-pjax-container\", timeout: false});
                });
                
            });
            
            $(\"form\").submit(function(e){ e.preventDefault(); });
        ");
?>

<?php Pjax::end() ?>

<?php else: ?>

<div class="container">
    <h1 class="mt-5">Carrello vuoto</h1>
    <p class="lead">Attualmente non vi sono articoli nel tuo carrello</p>
</div>


<?php endif; ?>




