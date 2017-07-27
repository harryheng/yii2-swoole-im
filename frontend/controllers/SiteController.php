<?php

namespace frontend\controllers;

use Yii;

use frontend\components\BaseController;

/**
 * 主布局
 */
class SiteController extends BaseController {

    public function actionIndex() {
        return $this->render('index');
    }
}
