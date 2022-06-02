<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 * @var $model \app\models\User
 */

$this->title = "Nuova password";
?>



<h1>
    <?= Html::encode($this->title) ?>
</h1>



<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'password_repeat')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Reset', ['class' => 'btn btn-success']) ?>
</div>


<?php ActiveForm::end() ?>

