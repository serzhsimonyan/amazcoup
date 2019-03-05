<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsPriceRantingUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = Product::with('promocode')->get();

        foreach ($products as $product) {
            if($product->price<=5) {
                Product::find($product->id)->update([
                    'rating' => $product->price,
                    'price' => ($product->discount_price)?($product->discount_price*100)/(100-$product->promocode->discount):null
                ]);
            }
        }
    }
}
