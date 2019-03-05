<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{

    protected $fillable = [
        'discount','promocode','url','start_date','end_date'
    ];
    
    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = [];
    
    public function products() {
        return $this->hasMany(Product::class,'promocode_id');
    }

}
