<?php

namespace App\SlotApi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Dcat\Admin\Http\Controllers\AuthController as BaseAuthController;

class AuthController extends Controller
{
    /**
     * 用户登录
     * @param Request $request
     * @return JsonResponse
     */
    public function postLogin(Request $request): JsonResponse
    {
        $credentials = $request->only(['name', 'password']);
        $validator = Validator::make($credentials,
            [
                'name' => 'required',
                'password' => 'required',
            ],
            [
                'required' => trans('admin.validation.required'),
            ]
        );

        if ($validator->fails()) {
            return $this->error(-201, 'validator error', $validator->errors()->messages());
        }
        $token = auth(config('admin.auth.guard'))->attempt($credentials);
        if ($token){
            return $this->success([
                    'name' => $credentials['name'],
                    'token' => $token,
                ]
            );
        }else{
            return $this->error(201,"账号或密码错误");
        }
    }

    /**
     * 用户退出登录
     * @param Request $request
     * @return void
     */
    public function getLogout(Request $request){
        auth(config('admin.auth.guard'))->logout();
        return $this->success([],200,"退出登录成功");
    }
}
