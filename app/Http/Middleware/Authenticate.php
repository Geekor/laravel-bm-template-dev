<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Geekor\Core\Support\GkApi as Api;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is("api/*")) {
                return Api::failx(Api::API_REQUEST_ERROR,
                    '请求 API 时，需要在 header 设置 Accept: application/json');
            }

            return route('login');
        }
    }
}
