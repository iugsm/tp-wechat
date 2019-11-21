<?php


namespace app\api\libs\exceptions;


class NotFoundException extends BaseException
{
    public $code = 404;
    public $msg = 'Not Found';
    public $errorCode = 3000;
}