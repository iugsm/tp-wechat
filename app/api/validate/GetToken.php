<?php


namespace app\api\validate;


class GetToken extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => 'code is empty, want to get token? no way!'
    ];
}