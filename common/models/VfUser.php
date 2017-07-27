<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use common\models\DbVfUser;

/**
 * VfUser model
 *
 */
class VfUser extends DbVfUser implements IdentityInterface {
    
    /**
     * 0    删除
     * 10   激活
     */
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * 实现接口
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * 实现接口
     * @param type $token
     * @param type $type
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    
    /**
     * 实现接口
     */
    public function getId() {
        return $this->getPrimaryKey();
    }
    
    /**
     * 实现接口
     */
    public function getAuthKey() {
        
    }

    /**
     * 实现接口
     */
    public function validateAuthKey($authKey) {
        
    }

    /**
     * 查找用户
     * @param type $username
     * @return type
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    public function validatePassword($password) {
        
    }
}
