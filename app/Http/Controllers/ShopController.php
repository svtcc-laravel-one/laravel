<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use http\Env\Request;

class ShopController extends Controller
{
    public function addlist()
    {
        if (Shop::query()->where('user_id',  session('user')['id'])->where('shop_id',request('shopid'))->count() <= 0) {
            $shop = new Shop;
            $shop->shop_id = request('shopid');
            $shop->user_id =  session('user')['id'];
            $shop->save();
            return response()->json(['message' => '加入购物车成功']);
        }else{
            return response()->json(['message' => '您的购物车已经有此件商品了，请不要重复加入购物车！'],401);
        }

    }
//    把userid传给vue判断
    public function dellist(){
        return Shop::query()->where('user_id',session('user')['id'])->with('products')->get();
    }
    public function info()
    {
        return session('user');
    }

//    删除一条数据
    public function delete($id){
        Shop::query()->find($id)->delete();
    }

}
