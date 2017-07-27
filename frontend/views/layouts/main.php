<?php

use yii\helpers\Html;

use frontend\assets\AppAsset;

AppAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>用户中心</title>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php $this->head();  ?>
        
        <script src="/static/main/js/live.js?v=<?php  echo time();  ?>"></script>
        
        <script type="text/javascript">
            var loginInfo = '<?php echo json_encode(Yii::$app->user->identity->attributes); ?>';
        </script>
    </head>
    
    <?php $this->beginBody(); ?>
    
    <body background="/static/login/bg/bg.jpg">
        <a href="/login/logout"/>退出</a>
        <?php echo $content ?>

    </body>
    
    <?php $this->endBody(); ?>
    
</html>
<?php $this->endPage() ?>