<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class ModalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        "js/modal-loader.js"
    ];

    public $depends = [
        AppAsset::class
    ];

    public $jsOptions = ["position" => View::POS_END];
}