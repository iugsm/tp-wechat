<?php


namespace app\api\service;


use app\api\libs\exceptions\WeChatException;
use app\api\model\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use think\facade\Config;

class Token
{
    protected $code;
    protected $appid;
    protected $appsecret;
    protected $loginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->appid = Config::get('WeChat.APPID');
        $this->appsecret = Config::get('WeChat.APPSECRET');
        $this->loginUrl = sprintf(Config::get('WeChat.LOGIN_URL'),
            $this->appid, $this->appsecret, $this->code);
    }

    public function make() {
        $wxResp = $this->requestWeChat();
        $token = $this->grantToken($wxResp['openid']);
        return $token;
    }

    private function requestWeChat() {
        $resp = curl_get($this->loginUrl);

        $wxResp = json_decode($resp, true);

        if (array_key_exists('errcode', $wxResp)) {
            throw new WeChatException([
                'msg' => $wxResp['errmsg'],
                'errorCode' => $wxResp['errcode']
            ]);
        }
        return $wxResp;
    }

    private function grantToken($openid) {
        $user = User::where('openid', $openid)->find();
        if ($user) {
            $uid = $user->id;
        } else {
            $user = User::create(['openid' => $openid]);
            $uid = $user->id;
        }

        $token = $this->makeJWT($uid);
        return $token;
    }

    private function makeJWT($uid) {
        $signer = new Sha256();
        $key = new Key(Config::get('Secure.JWT_KEY'));
        $time = time();
        $token = (new Builder())->issuedAt($time)
                                ->expiresAt($time + Config::get('Secure.JWT_EXPIRES'))
                                ->withClaim('uid', $uid)
                                ->getToken($signer, $key);
        return (string) $token;
    }

    public static function verifyJWT($token) {
        $parse = (new Parser())->parse((string) $token);
        $signer = new Sha256();
        $res = $parse->verify($signer, Config::get('Secure.JWT_KEY'));
        return $res;
    }

}