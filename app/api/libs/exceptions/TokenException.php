<?php


namespace app\api\libs\exceptions;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Invalid or expired token';
    public $errorCode = 2000;
}