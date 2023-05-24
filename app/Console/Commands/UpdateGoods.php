<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Goodsku;
use Illuminate\Console\Command;

class UpdateGoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:goods';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '迁移商品信息';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = fopen(base_path('/resources/data.csv'), 'r');
        fgetcsv($file);

        while ( ($row = fgets($file))!== FALSE){
            $row = explode(',', $row);
            $fa_title = trim($row[0]);
            $fa_img = trim($row[1]);
            $fa_category = trim($row[2]);
            $son_category = trim($row[3]);
            $fa_old_price = trim($row[4]);
            $fa_new_price = trim($row[5]);
            $category = $this->creatCategory($fa_category,$son_category);

            $goodsku = new Goodsku;
            $goodsku->good_info = $fa_title;
            $goodsku->good_img = $fa_img;
            $goodsku->good_category = $category->id;
            $goodsku->good_old_price = $fa_old_price;
            $goodsku->good_new_price = $fa_new_price;
            $goodsku->save();
        }
        return 0;
    }
    public function creatCategory(string $fa_category, string $son_category): Category
    {
//        $category = new  Category;
//        $category->category_name = $fa_category;
        // 创建父级分类，存在就跳过
        $parentModel = Category::query()->where("category_name",$fa_category)->first();
        if(!$parentModel) {
            $parentModel = new Category;
            $parentModel->category_name = $fa_category;
            $parentModel->parent_id =0;
            $parentModel->category_order=0;
            $parentModel->save();
        }
        // 创建子级分类，存在就跳过
        $childModel = Category::query()->where("category_name",$son_category)->first();
        if (!$childModel){
            $childModel = new Category;
            $childModel->category_name = $son_category;
            $childModel->parent_id = $parentModel->id;
            $childModel->category_order=0;
            $childModel->save();
        }
        return $childModel;
    }
}
