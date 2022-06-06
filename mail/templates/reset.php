
<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
/* @var $model \app\models\User instance of user */
?>
<h1> Recupero password  </h1>

<p> Se hai ricevuto la seguente mail è perchè hai richiesto un recupero della password .</p>
<p> Per proseguire clicca sul seguente <?= Html::a('Link', Url::to(['user/reset-password', 'idUser' => $model->idUser, "token" => $model->resetKey], true)) ?>
    per completare la procedura di recupero </p>




