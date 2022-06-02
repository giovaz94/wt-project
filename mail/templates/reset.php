
<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
/* @var $model \app\models\User instance of user */
?>
<h1>Password recovery </h1>

<p> This mail was automatically generated from the server.</p>
<p> Please click on this <?= Html::a('Link', Url::to(['user/reset-password', 'idUser' => 42, "token" => $model->resetKey], true)) ?>
    for resetting your password </p>




