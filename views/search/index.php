<?php


/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var int $count
 */

use yii\widgets\ListView;

$this->title = "Risultati di ricerca";
?>

<?= $this->render("@app/views/site/_search_bar")?>

<section class="search-result-section">
    <div class="container-fluid">
        <div class="home-section-title d-flex flex-wrap justify-content-start align-items-center">
            <h1 class="section-list-decor font-section">Risultati Trovati (<?= $count ?>)</h1>
        </div>
        <div class="d-flex justify-content-start align-top">
            <ul class="nav-nested-padding-search result-padding text-small">
                <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{pager}",
                        'itemView' => '_result_template',
                    ])
                ?>
            </ul>
        </div>
    </div>
</section>






