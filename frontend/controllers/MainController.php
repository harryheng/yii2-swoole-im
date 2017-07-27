<?php

namespace frontend\controllers;

use Yii;

use frontend\components\BaseController;

use common\models\VfUser;

/**
 * 主控制器
 */
class MainController extends BaseController {
    
    public function init() {
        $this->closeLayout();
    }
    
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionGetgroup() {
        $dataList = '';
	
        $user = VfUser::findOne(Yii::$app->user->id);
        $lists = VfUser::find()->where(['!=', 'id', Yii::$app->user->id])->asArray()->all();
        
        foreach($lists as &$value) {
//            $value['status'] = 'online';
        }
        
        $dataList['code'] = 0;
        $dataList['msg'] = 'success';
        $dataList['data']['mine'] = [
            'username' => $user['username'],
            'id' => $user['id'],
            'status' => 'online',
            'sign' => $user['sign'],
            'avatar' => $user['avatar'],
            
        ];
        
        $dataList['data']['friend'][] = [
            'groupname' => '世界领袖',
            'id' => '110',
            'list' => $lists
        ];
        
        $dataList['data']['group'] = [];
        
        return json_encode($dataList);
    }


    public function actionGetMsgCount() {
        return json_encode([
            'code' => 0,
            'msg' => '获取消息成功！',
            'data' => 3
        ]);
    }
    
    public function actionGetgroupex() {
        return json_encode([
            'code' => 0,
            'msg' => '群成员！',
            'data' => [
                'list' => []
            ]
        ]);
    }
    
    public function actionGetmsg() {
        return $this->render('getmsg');
    }
    
    public function actionAddfriend() {
        $lists = VfUser::find()->where(['!=', 'id', Yii::$app->user->id])->asArray()->all();
        
        return $this->render('addfriend', [
            'lists' => $lists
        ]);
    }
}
