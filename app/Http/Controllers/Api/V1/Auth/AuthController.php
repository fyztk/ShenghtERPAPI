<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/12
 * Time: 11:41
 */
namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BaseController;
use JWTAuth;
use App\Models\User;

class AuthController extends ApiController
{
    public function userLogin()
    {
        $validator = \Validator::make($this->request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $this->request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            $validator->after(function ($validator) {
                $validator->errors()->add('password', trans('auth.failed'));
            });
        }

        if ($validator->fails()) {
            return $this->errorBadRequest($validator->messages());
        }

        return $this->setStatusCode(200)->responseSuccessData(compact('token'));
    }

    public function userRegister()
    {
        $validator = \Validator::make($this->request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'deptid' => 'required',
            'realname' => 'required',
            'sex' => 'required',
            'phone' => 'required',
            'position' => 'required',
            'is_login' => 'required',
            'is_admin' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator->messages());
        }

        $newUser=[
            'username'=>$this->request->get('username'),
            'password'=>app('hash')->make($this->request->get('password')),
            'deptid' => $this->request->get('deptid'),
            'realname' => $this->request->get('realname'),
            'sex' => $this->request->get('sex'),
            'phone' => $this->request->get('phone'),
            'position' => $this->request->get('position'),
            'is_login' => $this->request->get('is_login'),
            'is_admin' => $this->request->get('is_admin'),
            'created_id' => $this->request->get('created_id'),
        ];

        $user=User::create($newUser);

        // 用户注册事件
        $token = JWTAuth::fromUser($user);

        return $this->setStatusCode(201)->responseSuccessData(compact('token'));
    }
    
    public function myUserInfo()
    {
        return $this->setStatusCode(200)->responseSuccessData($this->userInfo);
    }

    public function refreshToken()
    {
        $token = JWTAuth::parseToken()->refresh();
        return $this->setStatusCode(200)->responseSuccessData(compact('token'));
    }
}