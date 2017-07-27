<?php

namespace frontend\assets;

use yii\web\AssetBundle;

use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    
    public $css = [
        '/static/main/layui/css/layui.css',
        '/static/main/css/user.css'
    ];
    
    public $js = [
        '/static/main/layui/layui.js',
        '/static/main/js/jquery.min.js',
        '/static/main/js/pako.min.js',
        '/static/main/js/user.js?v=3.1',
//        '/static/main/js/live.js?v=3.1'
    ];
    
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
}
