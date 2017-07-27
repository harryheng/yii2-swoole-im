<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

use common\models\VfUser;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserModel extends Model {

    public $email;
    public $username;
    public $password;
    public $password_confirm;
    
    public $rememberMe = true;
    
    private $_user;

    public function rules() {
        return [
            [['username', 'password', 'password_confirm', 'email'], 'trim', 'on' => ['login', 'signup']],
            
            [['username', 'password'], 'required', 'on' => ['login', 'signup']],
            
            [['password_confirm', 'email'], 'required', 'on' => ['signup']],
            
            ['password', 'validatePassword', 'on' => ['login']],
            
            ['email', 'email', 'on' => ['signup']],
            
            [['email', 'username'], 'string', 'max' => 100, 'on' => ['signup']],
            
            ['password', 'string', 'max' => 30, 'min' => 6, 'on' => ['signup']],
            
            ['email', 'unique', 'targetClass' => '\common\models\VfUser', 'message' => '邮箱已存在.', 'on' => ['signup']],
            
            ['username', 'unique', 'targetClass' => '\common\models\VfUser', 'message' => '用户名已存在.', 'on' => ['signup']],
            
            ['password_confirm', 'validatePasswordConfirm', 'on' => ['signup']]
        ];
    }
    
    /**
     * 每个场景下验证的参数
     * @return type
     */
    public function scenarios() {
        return [
            'login' => ['username', 'password'],
            
            'signup' => ['username','password', 'password_confirm','email']
        ];
    } 

    /**
     * 验证密码
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user || $this->password != $user->password) {
                $this->addError($attribute, '用户名或密码不正确.');
            }
        }
    }
    
    public function validatePasswordConfirm($attribute) {
        $this->password != $this->password_confirm && $this->addError($attribute, '请再次输入相同的密码.');
    }

    /**
     * 登陆
     * @return bool
     */
    public function login() {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
    
    /**
     * 注册
     * @return type
     */
    public function signup() {
        $user = new VfUser();
        $user->attributes = $this->attributes;
        $user->status = VfUser::STATUS_ACTIVE;
        $user->create_at = date('Y-m-d H:i:s');
        $user->save();
        
        return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }

    /**
     * 查找用户
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = VfUser::findByUsername($this->username);
        }
        
        return $this->_user;
    }

    /**
     * 返回所有错误消息
     * @return string
     */
    public function getMessage($separate = '') {
        $errors = $this->getErrors();
        
        $message = '';
        array_walk($errors, function($value, $key) use (&$message) {
            !$message && $message = $value[0];
        });
        
        return $message;
    }
}
