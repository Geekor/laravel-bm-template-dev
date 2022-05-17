<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

use Geekor\Core\Support\GkApi as Api;
use Geekor\Core\Exceptions\PermissionException;
use Geekor\Core\Exceptions\InputException;

use BadMethodCallException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // -------------------
        // 只监听 API 错误并返回 JSON 错误信息
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is("api/*")) {
                return $this->handleApiRequest($e, $request);
            }
        });

    }

    private function handleApiRequest(Throwable $e, $request)
    {
        $msg = $e->getMessage();

        if ($e instanceof NotFoundHttpException) {
            return Api::failx404(' 路由【未定义】 >> /' . $request->path());
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return Api::failx405('请求该接口的【方法】有误 >> '.$request->method());
        }

        if ($e instanceof BadMethodCallException) {
            return Api::failx500(vsprintf('%s (%s)', [
                '路由【绑定】的方法不存在！', $msg
            ]));
        }

        // 身份认证失败
        if ($e instanceof AuthenticationException) {
            return Api::failx401();
        } else if ($e instanceof PermissionException) {
            return Api::failx403($msg ?? '你没有访问权限');
        }

        // 缺少设置 Accept 头
        if ($e instanceof RouteNotFoundException) {
            $contentTypes = $request->getAcceptableContentTypes();

            if (! in_array('application/json', $contentTypes)) {
                return Api::failx(Api::API_REQUEST_ERROR,
                    '请求 API 时，需要在 header 设置 Accept: application/json');
            }

            return Api::fail($msg);
        }

        // 参数有误
        if ($e instanceof InputException) {
            return Api::failx(Api::API_PARAM_MISS, $msg);
        }

        // --------------------------------- 未知错误 ---
        // dd($e);
        if (config('app.env') === 'production') {
            $fn = explode('/', $e->getFile());
            if (count($fn) > 4) {
                $fn = array_splice($fn, count($fn)-4);
            }
            $fn = '.../'. implode('/', $fn);

            return Api::failx(Api::JUST_FAILED, [
                'message' => $msg,
                'file' => $fn,
                'line' => $e->getLine() ?? '0'

            ], 500);
        }
    }
}
