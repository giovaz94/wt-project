<?php
/**
 * @var Notification $model
 */

use app\models\Notification;
use yii\helpers\Html;


$date = $model->getUserNotifications()
    ->addSelect("readDate")
    ->andWhere(["refUser" => Yii::$app->user->id])
    ->one()
    ->readDate;
?>
<li>
    <p class="line-break-custom format-custom titolo-libro"><?= Html::a($model->title, ["notification/view", "idNotification" => $model->idNotification]) ?></p>
    <div class="container container-notifiche justify-content-around">
        <div class="d-flex justify-content-between">
            <p class="paragrafo-notifiche mx-3"><?= Html::decode($model->body) ?></p>
            <div class="box-notifiche">
                <div class="<?= $date ? "box-read-active" : "box-read-inactive"?>"></div>
            </div>
        </div>
    </div>
</li>
