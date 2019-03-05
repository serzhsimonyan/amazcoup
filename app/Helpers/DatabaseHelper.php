<?php

namespace App\Helpers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DatabaseHelper {
    public static function footerContent() {

        if(Cache::has('footer_categories')) {
            return Cache::get('footer_categories');
        } else {
            $categories_db = Category::where('footer_show',1)->get();
           
            foreach($categories_db as $category) $categories[] = [
                'name' => $category->name,
                'slug' => $category->slug,
                'id' => $category->id
            ];
            Cache::put('footer_categories',$categories,now()->addMinutes(30));
            return $categories;
        }
    }

    public static function giftsUnderPriceAndPriceRange() {
        if(Cache::has('configurations')) {
            return Cache::get('configurations');
        } else {
            $configurations_db = DB::table('configurations')->first();
            $gifts_under_and_price_range = 
                ['gifts_under' =>$configurations_db->gifts_under_price,
                'price_range' => $configurations_db->price_range];
            Cache::put('configurations',$gifts_under_and_price_range,now()->addMinutes(30));
            return $gifts_under_and_price_range;
        }
    }

    public static function headerContent(){
        if(Cache::has('header_categories')) {
            return Cache::get('header_categories');
        } else {
             $categories = Category::withCount('products')->where('parent_id', 0)->get();

            $arr = [];
            foreach ($categories as $category) {
                $arr[$category->id] = $category->products_count;
            }
            arsort($arr);
            $header = $categories->whereIn('id', array_keys(array_slice($arr, 0, 3, true)));
            Cache::put('header_categories',['header'=>$header,'show_categories'=>$categories],now()->addMinutes(60));
            return ['header'=>$header,'show_categories'=>$categories];
        }

    }
}