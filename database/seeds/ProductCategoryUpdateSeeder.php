<?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoryUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ProductCategory::all();
        foreach ($products as $pr) {
            $prod = ProductCategory::where([
                ['product_id', '=', $pr->product_id],
                ['category_id','=',$pr->category_id]
            ])->get();

            if($prod and count($prod)>=2) {
                ProductCategory::find($prod->first()->id)->delete();
            }
        }
    }
}
