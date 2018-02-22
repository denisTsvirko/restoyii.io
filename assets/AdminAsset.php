<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/bootstrap/bootstrap.min.css',
        //'css/bootstrap/bootstrap-responsive.css',
        'css/admin.css',
    ];
    public $js = [
        'js/goup.js',
        //'js/bootstrap/bootstrap.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}