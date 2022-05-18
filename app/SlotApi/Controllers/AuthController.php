<?php

namespace App\SlotApi\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SlotGameUser;
use App\Rules\RegisterUnique;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * 用户注册
     * @param Request $request
     * @return JsonResponse
     */
    public function postRegister(Request $request): JsonResponse
    {
        $credentials = $request->only(['name', 'password','email','password_confirmation']);
        $where = [
            'name'=>$credentials['name'],
            'email'=>$credentials['email'],
        ];
        $validator = Validator::make($credentials,
            [
                'password' => 'required|confirmed',
                'password_confirmation' => 'required|same:password',
                'email' => 'required|email',
                'name' => ['required','between:2,20',new RegisterUnique($where)],
            ],
            [
                'required' => trans('admin.validation.required'),
                'name.between' => trans('admin.validation.between'),
                'password.required' => trans('admin.validation.password.required'),
                'password.confirmed' => trans('admin.validation.password.confirmed'),
                'email' => trans('admin.validation.email'),
            ]
        );
        if ($validator->fails()) {
            return $this->error(-201, 'validator error', $validator->errors()->messages());
        }
        $user = SlotGameUser::create([
            'name'=>$credentials['name'],
            'email'=>$credentials['email'],
            'password'=>bcrypt($credentials['password']),
        ]);
        $token = auth(config('admin.auth.guard'))->login($user);
        if ($token){
            return $this->success([
                    'name' => $credentials['name'],
                    'token' => $token,
                ]
            );
        }else{
            return $this->error(201,"账号注册失败,稍后再试");
        }
    }
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
     * @return JsonResponse
     */
    public function getLogout(Request $request): JsonResponse
    {
        auth(config('admin.auth.guard'))->logout();
        return $this->success([],200,"退出登录成功");
    }
}
