<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
class RatingUpdateToPopular extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       Product::where('rating','>=',4)->update(['popular' => 1]);
    }
}
