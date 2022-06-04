<?php
/**
 * @var Notification $model
 */

use app\models\Notification;
use yii\helpers\Html;

?>
<li>
    <p class="line-break-custom format-custom titolo-libro"><?= $model->title ?></p>
    <div class="col-sm-8 d-flex justify-content-around">
        <p><?= Html::encode($model->body) ?></p>
        <div class="px-2">
            <p class="box-quantity"></p>
        </div>
    </div>
</li>
