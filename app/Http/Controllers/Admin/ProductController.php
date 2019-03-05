<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\StringHelper;
use App\Models\Category;
use App\Services\GazzleClass;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }
    
    public function showProductsPage() {
        return view('admin.products');
    }

    public function dashboardTable () {
        return Datatables::of(Product::query()->orderBy('updated_at', 'desc'))->make(true);
    }

    public function showEditProductPage($asin) {
        if(!$asin) return abort(404);
        $product = Product::with('categories')->where('asin',$asin)->first();
        if(!$product) return abort(404);
        return view('admin.edit-product',['product' => $product,'categories' => Category::all()]);
    }
    
    public function editProduct(Request $request) {

        $id = $request->input('id');
        if(!$id) return abort(404);
        $product = Product::find($id);
        if(!$product) return abort(404);
        $delete_categories = $request->input('delete_categories');
        if($delete_categories){
           $product->categories()->detach($delete_categories);
        };
        $add_categories = $request->input('add_categories');
        if($add_categories) {
           $product->categories()->attach($add_categories);
        }
        $request->validate([
            'title' => 'required|min:4|max:189',
            'description' => 'min:4',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'discount_price' => 'nullable|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'popular' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png | max:1000',
        ]);
        
        $image = $request->file('image');
        $price = $request->input('price');
        $discount_price = $request->input('discount_price');
        $title = $request->input('title');
        $description = $request->input('description');
      
        if($image) $product->image = $request->root().'/'.$image->store('images/uploads');
        if($price) $product->price = $price;
        if($discount_price) $product->discount_price = $discount_price;
        if($description) $product->description = $description;
        if($title) {
            $product->title = $title;
            $product->slug = StringHelper::titleToSlug($title);
        }
        $product->save();
        $this->complateMessage();
        return redirect('admin/edit/'.$product->asin);
    }

    public function deleteProduct(Request $request) {
        $id = $request->input('id');
        if(!$id) return response()->json(['slug_error' => 'Sorry something went wrong,please try again'],400);
        $product = Product::find($id);
        if(!$product) return response()->json(['error_404'=>'Sorry something went wrong,please try again'],400);
        $product->delete();
        return response()->json(['complete'=>'Your request completed successfully!'],200);
    }
    
    public function showAddProductPage() {
        return view('admin.add-product',['categories'=> Category::all()]);
    }
    
    public function addProduct(Request $request) {
        $request->validate([
            'url' => 'required',
        ]);
        $url = $request->input('url');
        $category = Category::find($request->input('category'));
        $category_id = ($category)? $category->id:null;
        if(strpos($url,'/?')) {
            $url = substr($url,0,strpos($url,'/?'));
        } else if (strpos($url,'/r')) {
            $url = substr($url,0,strpos($url,'/ref'));
        } else {
            return back()->withInput()->withErrors(['url' => 'undefined url']);
        }

        try {
            $data = GazzleClass::getDataFromWebsite($url);
            $product = Product::create($data);
            if(!$product) {
                session()->flash('error','sorry can not add product,please try again');
                return back();
            }
            if($data) {
                $array=[];
                foreach ($data as $key=>$v){
                    if(null) {
                        array_push($array,$key);
                    }
                }
                if($category_id)  $product->categories()->attach($category->id);
                return redirect('/admin/edit/'.$product->asin)->with(['empty_values' => $array]);
            }
        } catch (Exception $e) {
            if ($e instanceof GuzzleException) {
               return back()->withInput()->withErrors(['url' => 'undefined url']);
            } else {
                session()->flash('error','sorry can not add product');
                return back();
            }
        }
     }
    
    
    public function complateMessage() {
        session()->flash('complete', 'Your request completed successfully!');
    }

}
