<?php


/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

use yii\widgets\ListView;

?>


<h1> Search Results </h1>
<p> bla, bla, bla....</p>

<?=
ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
])
?>



