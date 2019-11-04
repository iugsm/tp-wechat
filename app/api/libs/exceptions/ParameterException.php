<?php


namespace app\api\libs\exceptions;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = 'Invalid parameter';
    public $errorCode = 1000;
}