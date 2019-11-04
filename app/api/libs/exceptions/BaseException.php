<?php


namespace app\api\libs\exceptions;


use think\Exception;

class BaseException extends Exception
{
    public $code = 400;
    public $msg = 'Invalid request scheme';
    public $errorCode = 1000;

    /**
     * BaseException constructor.
     * @param array $params
     */
    function __construct($params = []) {
        if (!is_array($params)) {
            return;
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errorCode', $params)) {
            $this->errorCode = $params['errorCode'];
        }
    }
}