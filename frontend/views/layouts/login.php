<?php

use yii\helpers\Html;
use frontend\assets\LoginAsset;

LoginAsset::register($this);

$this->beginPage();
?>

<!DOCTYPE html>
<html lang="en">  
    <head>
        <?php
            echo Html::tag('title', Yii::$app->name . '风居住的地方');
            
            echo Html::tag('meta', '', [
                'http-equiv' => 'Content-Type',
                'content' => 'text/html',
                'charset' => 'UTF-8'
            ]);

            echo Html::csrfMetaTags();

            $this->head();

            $this->registerJs('$(document).ready(function () {
                Login.init()
            })', 1);
        ?>
    </head>

    <?php $this->beginBody(); ?>
    
    <body class="login" background="/static/admin/bg/bg.jpg">    
        <div class="logo">            
            <img src="/static/admin/assets/img/logo.png" alt="logo" /><?= Yii::$app->name ?>
        </div>

        <div class="box">
            <div class="content">
                <?php
                
                    echo $content;
                    
                ?>

            </div>
            <div class="inner-box">
                <div class="content">
                    <i class="icon-remove close hide-default">
                    </i>
                    <a href="#" class="sign-up">
                        没有账号？点我注册
                    </a>
                </div>
            </div>
        </div>
    </body>
<?php $this->endBody(); ?>
</html>

<?php $this->endPage() ?>