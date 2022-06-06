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
    <div class="col-sm-8 d-flex justify-content-around">
        <p><?= Html::encode($model->body) ?></p>
        <div class="px-2">
            <div class="<?= $date ? "box-read-active" : "box-read-inactive"?>"></div>
        </div>
    </div>
</li>
