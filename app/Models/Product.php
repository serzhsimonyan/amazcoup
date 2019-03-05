<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
   // use SoftDeletes;

    protected $fillable=['title','url','slug','asin','image','price','discount_price','rating','description','promocode_id'];

    protected $hidden=[];

    protected $dates = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot();
        static::deleting(function (Product $product) {
            $product->categories()->detach();
        });
    } 

   
    public function categories() {
        return $this->belongsToMany(Category::class,'product_categories');
    }
    
    
    public function promocode() {
        return $this->belongsTo(Promocode::class,'promocode_id');
    }
}
