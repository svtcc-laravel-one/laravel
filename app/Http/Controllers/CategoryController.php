<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Goodsku;

class CategoryController  extends Controller{
    public function parent()
    {
        return Category::query()->where('parent_id', 0)->orderBy('category_order','desc')->get(['id','category_name']);
    }
    public function child(int $id){
        return  Category::query()->where('parent_id', $id)->orderBy('category_order','desc')->get(['id','category_name']);
    }
    public function xid(int $id){
        return  goodsku::query()->where('id', $id)->get(['id','good_info','good_img','good_new_price','good_surplus','good_old_price','good_discount']);

    }
//    返回X类的数据
    public function sku(){
        $limit = request("size",3);
        $cate = request("category",1);
        return $this->getSkuByParentId($cate,$limit);
    }
//    获取主分类的id
    public function getParentId($id){
        $parent = Category::query()->where('id', $id)->first();
        if ($parent->parent_id == 0){
            return $parent;
        }else {
            return $category = Category::query()->where('id', $parent->parent_id)->get();
        }
    }
    public function all(){
        return Goodsku::query()->get();
    }

//    返回X类的数据
    protected function getSkuByParentId($id,$limit){
        return Goodsku::query()
            ->leftJoin('category','category.id','goodsku.good_category')
            ->where('category.parent_id',$id)
            ->limit($limit)
            ->get(['goodsku.id','good_info','good_old_price','good_new_price','good_img','good_surplus']);
    }
}
