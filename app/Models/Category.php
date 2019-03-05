<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name','slug','description','parent_id','footer_show',
    ];
    protected $dates = ['created_at', 'updated_at'];
    
    protected $hidden = [];

    public static function boot() {
        parent::boot();
        static::deleting(function (Category $category) {
            $category->products()->delete();
            $category->sub_categories()->delete();
        });

    }
    public function products() {
        return $this->belongsToMany(Product::class,'product_categories');
    }

    public function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
         return $this->belongsTo(Category::class, 'parent_id');
    }



}
