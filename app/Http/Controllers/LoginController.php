<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(): JsonResponse
    {
        $username = request('username');
        $password = request('password');
        $userModel = User::query()->where('username', $username)->first();
        if(!$userModel){
            return  response()->json(['error' => '用户不存在'], 401);
        }
        if($password != $userModel->password){
            return  response()->json(['error' => '密码错误'], 401);
        }
        session(['user' => $userModel]);
        return response()->json(['success' => '登录成功'], 200);
    }
    public function register(): JsonResponse
    {
        $username = request('username');
        $password = request('password');
        if (!$username || !$password ){
            return  response()->json(['error' => '用户名或密码不能为空'], 401);
        }

        $userModel = User::query()->where('username', $username)->first();
        if($userModel) return  response()->json(['error' => '用户已存在'], 401);
        $userModel = new User();
        $userModel->username = $username;
        $userModel->password = $password;
        $userModel->save();
        return response()->json(['success' => '注册成功'], 200);
    }
}

