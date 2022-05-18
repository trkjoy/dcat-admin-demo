<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header("Authorization");
        $this->checkForToken($request);
        try {
            if ($this->auth->parseToken()->authenticate()){
                return $next($request);
            }
        }catch (JWTException $exception){
            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这⾥需要做的是刷新该⽤户的 token 并将它添加到响应头中
            try {
                $token = $this->auth->refresh();
                // 使⽤⼀次性登录以保证此次请求的成功
                auth(config('admin.auth.guard'))->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
            }catch (TokenBlacklistedException $e){
                // 如果捕获到此异常，即代表 refresh 也过期了，⽤户⽆法刷新令牌，需要重新登录。
                throw new UnauthorizedHttpException('jwt-auth',$e->getMessage());
            }
        }
        return $this->setAuthenticationHeader($next($request),str_replace('Bearer ','',$token));
    }
}
