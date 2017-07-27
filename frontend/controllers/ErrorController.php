<?php

namespace frontend\controllers;

use Yii;
use yii\web\HttpException;
use yii\base\Exception;
use yii\base\UserException;

use frontend\components\BaseController;

/**
 * Description of ErrorController
 * 错误响应处理控制器
 * @author wangjiacheng
 */
class ErrorController extends BaseController {

    /**
     * @var [] HTTP状态码和相应的文本
     */
    public static $httpStatuses = [
        0 => '系统响应异常',
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        118 => 'Connection timed out',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        210 => 'Content Different',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Reserved',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        310 => 'Too many Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => '<h2>世界那么大，偶尔会迷路，请稍后重试!</h2>',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range unsatisfiable',
        417 => 'Expectation failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable entity',
        423 => 'Locked',
        424 => 'Method failure',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway or Proxy Error',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        507 => 'Insufficient storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];
    
    /**
     * 异常错误响应
     * @return type
     */
    public function actionError() {
        $this->closeLayout();
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new HttpException(404, 'yii', '你正在寻找的页面无法找到.');
        }
        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        
        $message = self::$httpStatuses[$code] ? self::$httpStatuses[$code] : self::$httpStatuses[0];
        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$code: $message";
        } else {
            return $this->render('error', [
                'message' => $message,
                'code' => $code,
            ]);
        }
    }
}
