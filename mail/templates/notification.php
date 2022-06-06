<?php
    /* @var $this \yii\web\View view component instance */
    /* @var $message \yii\mail\BaseMessage instance of newly created mail message */
    /* @var $user \app\models\User instance of user */
    /* @var $notification \app\models\Notification*/

use yii\helpers\Html;
use yii\helpers\Url;


?>

<h1>Nuova notifica: "<?= $notification->title ?>" </h1>

<p> Hai ricevuto una nuova notifica in data <?= $notification->dateOfCreation ?>: </p>

<h2> Messaggio ricevuto: </h2>
<p> <?= $notification->body ?></p>


<p> Consulta il seguente <?= Html::a('Link', Url::to(['notification/view', 'idNotification' => $notification->idNotification], true)) ?> per visualizzarla
</p>
