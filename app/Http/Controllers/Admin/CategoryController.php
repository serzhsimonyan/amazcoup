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

class CategoryController extends Controller
{
    
    /////////////Add category///////////
    public function addCategory(Request $request) {
        $request->validate([
            'name' => 'required|min:4|max:120|regex:/[a-zA-Z\&\+]/i',
            'description' => 'nullable|min:4|max:1200',
        ]);

        $parent_category = $request->input('parent_category');
        $description = $request->input('description');
        $parent_category = ($parent_category)? Category::where('name', $parent_category)->first():null;
        $name = $request->input('name');

        $category = Category::create([
            'name' => $name,
            'slug' => StringHelper::titleToSlug($name),
            'description' => $description,
            'parent_id' => $parent_category ? $parent_category->id : null,
        ]);


      if($category) {
          $this->complateMessage();
          return back();
      }
        session()->flash('error', 'Sorry can not add th category');
        return back();
    }
    /////////////////////add category page//////////
    public function showAddCategoryPage() {
        return view('admin.add-category',['categories'=>Category::select('name')->where('parent_id',0)->get()]);
    }
     ////////////////////////////Edit category///////////////
    public function editCategory(Request $request) {
        $id = $request->input('id');
        if(!$id) return back()->withErrors(['error' => 'sorry something went wrong,please try again']);
        $category = Category::find($id);
        if(!$category) return abort(404);
        $request->validate([
            'name' => 'required|min:4|max:160',
            'footer_show' => 'required',
            'description' => 'nullable|min:4',
        ]);

        if($request->input('category_delete')) {
            $category->delete();
            $this->complateMessage();
            return redirect('admin/edit/categories');
        }
        $name = $request->input('name');
        $category->description = $request->input('description');
        $category->name = $name;
        $category->slug = StringHelper::titleToSlug($name);
        ($request->input('footer_show') == 1)? $category->footer_show = 1:$category->footer_show = 0;
        $category->save();
        if($category) {
            $this->complateMessage();
            return redirect('admin/edit/category/'.$category->slug.'/'.$category->id);
        }
        session()->flash('error', 'Sorry can not save edits');
        return back();
    }
    //////////////////
    public function showEditCategoriesPage($slug = null,$category_id) {
        if(!$slug and !$category_id) return abort(404);
        $category = Category::where([['slug',$slug],['id','=',$category_id]])->first();
        if(!$category) return abort(404);
        return view('admin.edit-category',['category'=>$category]);
    }

    ///////////////////////////all categories page///////
    public function showCategoriesPage() {
        return view('admin.categories');
    }
         /////////////////
    public function categoriesTable() {
        return Datatables::of(Category::query()->orderBy('updated_at', 'desc'))->make(true);
    }
//////////////////////////////////////////////
    
    public function complateMessage() {
        session()->flash('complete', 'Your request completed successfully!');
    }
}
