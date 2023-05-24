<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login',[LoginController::class,'login']);
Route::post('/register',[LoginController::class,'register']);


//获取父级分类
Route::get('/category/parent',[CategoryController::class,'parent']);
//获取子级分类
Route::get('/category/child/{id}',[CategoryController::class,'child']);
//获取所有数据
Route::get('/goodsku/sku',[CategoryController::class,'sku']);
//获取主分类id
Route::get('/category/getParentId/{id}',[CategoryController::class,'getParentId']);

Route::get('/goodsku/all',[CategoryController::class,'all']);

//获取id为x的所有数据
Route::get('/goodsku/xid/{id}',[CategoryController::class,'xid']);



//获取用户信息
Route::middleware(['user_auth'])->group(function (){
    //登录获取信息
    Route::get('/user/info',[UserController::class,'info']);
    //退出登录
    Route::get('/logout',[LoginController::class,'logout']);
    //获取购物车信息
    Route::get('/shop/info',[ShopController::class,'info']);
    //Vue传值传购物信息id和用户的id
    Route::post('/goodsku/xid',[ShopController::class,'addlist']);
    //把购物车的userid传出判断购物车
    Route::get('shop/dellist',[ShopController::class, 'dellist']);
//    删除购物车数据
    Route::post('/shop/del/{id}',[ShopController::class,'delete']);
});
