<?php

use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/ico" href="/images/favicon.ico" />
        <title><?= Html::encode(\Yii::$app->name); ?></title>   
    </head>
    <style>


        .error-full-page .page-error {
            margin-top: 60px;
        }
        .page-error {
            text-align: center;
        }
        .pad-30 {
            padding: 30px!important;
        }
        .page-error .error-number {
            display: block;
            font-size: 158px;
            font-weight: 450;
            letter-spacing: -10px;
            line-height: 150px;
            margin-top: 0;
            text-align: center;

        }
        .page-error .error-details {
            display: block;
            padding-top: 0;
            text-align: center;
        }
        .page-error .error-details .btn-return {
            margin: 15px 0;
        }


    </style>
    <body class="bg-4">
        <div class="main">

            <div class="row">

                <div class="col-md-12">

                    <div id="content" class="content-container animate-fade-up ng-scope" ng-view=""><div class="error-full-page ng-scope"> 
                            <!-- start: 404 -->
                            <div class="col-sm-12 page-error pad-30">
                                <div class="error-number text-primary"> <?= $code ?> </div>
                                <div class="error-details col-sm-6 col-sm-offset-3">
                                    <!-- end: 404 --><h3> Oops! You are error at <?= $code ?></h3>
                                    <p> <?= $message ?>
                                        <a href="<?= \Yii::$app->homeUrl ?>" class="btn btn-danger btn-return"> <i class="fa fa-home"> </i> 返回首页 </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div> 
    </body>
</html>