<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\Response;

use frontend\models\UserModel;
use frontend\models\SignupForm;

/**
 * 主控制器
 */
class LoginController extends Controller {
    
    public $layout = 'login';
    
    public $enableCsrfValidation = false;

    public function init() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        Yii::$app->request->isPost && Yii::$app->response->format = Response::FORMAT_JSON;
    }
    
    /**
     * 用户登录
     */
    public function actionLogin() {
        $model = new UserModel(['scenario' => 'login']);
        
        if (Yii::$app->request->isPost) {
            $model->attributes = array_map('trim', $_POST);
            
            if ($model->validate() && $model->login()) {
                
                return ['status' => 0, 'msg' => '登录成功', 'url' => Url::to(['site/index'])];
            } else {
                return ['status' => 1, 'msg' => $model->getMessage(), 'url' => ''];
            }
        }
        
        return $this->render('login', ['model' => $model]);
    }
    
    /**
     * 注册
     */
    public function actionSignup() {
        $model = new UserModel(['scenario' => 'signup']);
        
        if (Yii::$app->request->isPost) {
            $model->attributes = $_POST;
            
            if ($model->validate() && $model->signup()) {
                
                return ['status' => 0, 'msg' => '注册成功', 'url' => Url::to(['site/index'])];
            } else {
                return ['status' => 1, 'msg' => $model->getMessage(), 'url' => ''];
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * 退出登录
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
