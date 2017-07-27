<?php

namespace frontend\components;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * 基类控制器
 * @author wangjiacheng
 */
class BaseController extends Controller {
    
    const STATUS_SUCCESS = 0;           // 操作成功的状态
    const STATUS_ERROR = 100;             // 操作失败的状态
    
    const MSG_SUCCESS = '操作成功!';    // 成功提示
    const MSG_ERROR = '操作失败!';       // 失败提示

    /**
     * 每页显示数量
     */
    protected $_pageSize = 50;

    /**
     * 主布局文件
     * @var type 
     */
    public $layout = '';

    /**
     * 面包屑数据
     * @var type 
     */
    public $breadcrumbs = [];

    /**
     * 初始化
     */
    public function init() {
        $this->layout = $this->getLayoutView();
    }

    /**
     * 执行前操作
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
        if(parent::beforeAction($action) && Yii::$app->user->isGuest){ 
            $this->redirect(['login/login']);
            return false;
        }
        
        return true;
    }

    /**
     * 执行后操作
     * @param type $action
     * @param type $result
     * @return type
     */
    public function afterAction($action, $result) {
        return parent::afterAction($action, $result);
    }

    /**
     * 关闭控制器布局器
     */
    protected function closeLayout() {
        $this->layout = false;
    }
    
    /**
     * 设置布局
     * @param type $layout  布局
     */
    protected function setLayout($layout) {
        $this->layout = $layout;
    }
    
    /**
     * 设置分页大小
     * @param type $pageSize  页大小
     */
    protected function setPageSize($pageSize) {
        $this->_pageSize = $pageSize;
    }

    /**
     * 获取主布局文件
     * @return string
     */
    protected function getLayoutView() {
        return 'main';
    }
}
