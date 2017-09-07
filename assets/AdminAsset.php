<?php
/**
 * Created by PhpStorm.
 * User: Alpo4
 * Date: 29.08.2017
 * Time: 16:32
 */

namespace app\assets;
use yii\web\AssetBundle;

class AdminAsset extends AssetBundle{

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