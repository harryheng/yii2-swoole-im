<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * 登陆资源配置
 */
class LoginAsset extends AssetBundle {
    public $basePath = '@webroot';
    
    public $css = [
        '/static/login/bootstrap/css/bootstrap.min.css',
        '/static/login/assets/css/main.css',
        '/static/login/assets/css/plugins.css',
        '/static/login/assets/css/responsive.css',
        '/static/login/assets/css/icons.css',
        '/static/login/assets/css/login.css',
        '/static/login/assets/css/fontawesome/font-awesome.min.css'
    ];
    
    public $js = [
        '/static/login/assets/js/libs/jquery-1.10.2.min.js',
        '/static/login/bootstrap/js/bootstrap.min.js',
        '/static/login/assets/js/libs/lodash.compat.min.js',
        '/static/login/plugins/uniform/jquery.uniform.min.js',
        '/static/login/plugins/validation/jquery.validate.min.js',
        '/static/login/plugins/nprogress/nprogress.js',
        '/static/login/assets/js/login.js'
    ];
    
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];

}
