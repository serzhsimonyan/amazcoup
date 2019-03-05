<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Promocode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getCategory($link)
    {
        if(!$link) return abort(404);
        $category_id = substr($link,strrpos($link,'-')+1);
        if(!ctype_digit($category_id)) return abort(404);
        $slug = substr($link,0,strrpos($link,'-'));

        $currentCategory = Category::where([['slug',$slug ],['id',$category_id]])->withCount('products')->first();
          $childCategories = [];
        if(!$currentCategory)  return view('category');
            $childCategoriesAll = $currentCategory->sub_categories()->withCount('products')->get();
            foreach ($childCategoriesAll as $child) {
                if($child->products_count) {
                    $childCategories[] = $child;
                }
            }



        return view('category', compact('currentCategory','childCategories'));
    }

    public function getProducts($asin) {

        if(!$asin) return abort(404);
        $product = Product::with(['categories','promocode'])->where('asin',$asin)->first();

        if (!$product) return view('single');
        $categories = $product->categories;
        $category = $categories->first();

        if(!$category) return view('single',compact('product'));
        $products = Product::with('promocode')->whereHas('promocode', function ($query) {
               $query->whereDate('end_date', '>', date('Y-m-d H:i:s'));
            })->whereHas('categories', function($q) use ($category) {
                $q->where('category_id', $category->id);
            })->where([
                ['price','!=',null],
                ['price','!=',0],
                ['discount_price','!=',null],
                ['discount_price','!=',0],
                ['id', '!=', $product->id]
            ])->orderBy('rating', 'DESC')->groupBy('title')->limit(20)->get();
//            $products = Product::with('promocode')->whereHas('categories', function($q) use ($category) {
//                $q->where('category_id', $category->id);
//            })->orderBy('rating', 'DESC')->groupBy('title')->limit(20)->get();
        if($products->count() >= 8) {
            $products = $products->random(8);
        }
        return view('single',compact('product','products','categories'));
    }

    public function search(Request $request)
    {
            $category_id = $request->input('category_id');
            $filter = $request->input('filter');
            $search = $request->input('search');
            $range = $request->input('range');
            $builder = Product::with('promocode')->whereHas('promocode', function ($query) {
                       $query->whereDate('end_date', '>=', date('Y-m-d H:i:s'));
                    })
                ->where([
                      ['price', '<>', null],
                      ['discount_price', '<>', null],
                      ['discount_price', '<>', 0],
                      ['price', '<>', 0],
                ]);


         //  $builder = Product::query();
            // check category
            if ($category_id) {
                    $builder->whereHas('categories', function ($query) use ($category_id) {
                        $query->where('category_id', $category_id);
                    })->groupBy('price','title');
            }
        
            // check filter
            if ($filter) {

                switch ($filter) {
                    case 'newest':
                        $builder->where([
                            ['created_at', '<=', Carbon::now()->addMonths(3)->toDateTimeString()],
                        ])->groupBy('price','title');
                        break;

                    case 'popular':
                        $builder->where('rating', '>=', 4)->groupBy('price','title');
                        break;

                    case 'random':
                        $p = Product::whereHas('promocode', function ($query) {
                            $query->whereDate('end_date', '>=', date('Y-m-d H:i:s'));
                        })->limit(1000)->groupBy('title')->get();
                        if(count($p)>18) $p = $p->random(18)->pluck('id');
                        $builder->whereIn('id',$p);
                }
            }

            // check search keyword
            if ($search) {
                $builder->where('title', 'like', "%$search%");
            }

            // check range filtering
            if ($range) {
                 $builder->whereBetween('price', explode(':', $range))->groupBy('price','title');
            }

            $products = $builder->orderBy('updated_at', 'desc')->paginate(18);

            $html = '';
            foreach ($products as $product) {
                $html .= view()->make('product', compact('product'));
            }

        $paginate = ''.view()->make('layouts.paginate', compact('products'));
      
        return json_encode([
            'html' => $html,
            'paginate' => $paginate
        ]);
    }

}
