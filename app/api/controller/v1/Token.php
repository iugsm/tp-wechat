<?php


namespace app\api\controller\v1;


use app\api\libs\exceptions\BaseException;
use app\api\libs\exceptions\TokenException;
use app\api\validate\GetToken;
use think\facade\Request;
use app\api\service\Token as TokenService;

class Token
{
    public function get() {
        (new GetToken())->goCheck();
        $code = Request::param('code');
        $ts = new TokenService($code);
        $token = $ts->make();
        return json($token);
    }

    public function verify() {
        $token = Request::header('token');
        if (!$token) {
            throw new TokenException();
        }

        $valid = TokenService::verifyJWT($token);
        return json([
            'is_valid' => $valid
        ]);
    }
}