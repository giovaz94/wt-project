<?php

use app\models\ProductCategory;
use app\models\ProductTypology;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->errorSummary($model); ?>


    <fieldset class="dati-prodotto">
        <legend class="form">Prodotto</legend>
        <div class="row">
            <div id="dati-prodotto-nome" class="form dati-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'fileLoader')->fileInput(['class' => 'form-control', 'accept' => "image/*"])->label("Image")?>
            </div>
            <div id="dati-prodotto-nome" class="form dati-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'name')->textInput(['class' => 'form-control', 'maxlength' => true]) ?>
            </div>
            <div id="dati-prodotto-categoria" class="form dati-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'refProductCategory')->dropDownList(ArrayHelper::map(ProductCategory::find()->all(),'idProductCategory','name'))?>
            </div>
            <div class="separator"></div>
            <div id="dati-prodotto-descrizione" class="form dati-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'description')->textarea([ 'class' => 'form-control-lg', 'rows' => 6]) ?>
            </div>
            <div class="separator"></div>
            <div id="dati-prodotto-prezzo" class="form dati-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
        </div>
    </fieldset>
    <hr>
    <fieldset class="informazioni-prodotto">
        <legend class="form">Informazioni</legend>
        <div class="row">
            <div id="informazioni-prodotto-numero-pagine" class="form informazioni-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'totalPages')->input("number", ['class' => "form-control"]) ?>
            </div>
            <div class="separator"></div>
            <div id="informazioni-prodotto-pubblicazione" class="form informazioni-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'publication')->input("date", ['class' => "form-control"]) ?>
            </div>
            <div id="informazioni-prodotto-autore" class="form informazioni-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="separator"></div>
            <div id="informazioni-prodotto-tipologia" class="form informazioni-prodotto col-sm-7 col-lg-7">
                <?= $form->field($model, 'refProductTypology')->dropDownList(ArrayHelper::map(ProductTypology::find()->all(),'idProductTypology','name')) ?>
            </div>
        </div>
    </fieldset>
    <div class="container text-center">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Inserisci prodotto</button>
    </div>
<?php ActiveForm::end(); ?>
