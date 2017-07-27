<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vf_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $status
 * @property string $sign
 * @property string $avatar
 * @property integer $age
 * @property string $create_at
 */
class DbVfUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vf_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'age'], 'integer'],
            [['create_at'], 'safe'],
            [['username', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 30],
            [['sign', 'avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Status',
            'sign' => 'Sign',
            'avatar' => 'Avatar',
            'age' => 'Age',
            'create_at' => 'Create At',
        ];
    }
}
