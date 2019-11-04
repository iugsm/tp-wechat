<?php
namespace app;

use app\api\libs\exceptions\BaseException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\Env;
use think\Response;
use Throwable;
use think\facade\Request as Req;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        $isDebug = Env::get('APP_DEBUG');

        if (!$isDebug && !$exception instanceof BaseException) {
            parent::report($exception);
        }
    }

    /**
     * Render an exceptions into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        $reqUrl = Req::baseUrl();
        $reqMethod = Req::method();

        $code = 200;

        $data = [
            'request' => $reqMethod . ' ' . $reqUrl
        ];

        if ($e instanceof BaseException) {
            $data['msg'] = $e->msg;
            $data['err_code'] = $e->errorCode;
            $code = $e->code;
        } else {
            $data['msg'] = 'sorry, we make a mistake...';
            $data['err_code'] = 999;
            $code = 500;

            $isDebug = Env::get('APP_DEBUG');

            if ($isDebug) {
                return parent::render($request, $e);
            }
        }

        return json($data, $code);
    }
}
