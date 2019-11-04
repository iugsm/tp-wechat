<?php


namespace app\api\libs\exceptions;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = 'WeChat unknown error';
    public $errorCode = 1001;
}