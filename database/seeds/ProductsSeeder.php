<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $products->each(function($prod) {
            Product::updateOrCreate([
                $prod
            ]);
        });
    }
}
