<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryNameToSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $text = mb_strtolower(trim(implode("-",explode(' ',preg_replace('/\s+/',' ',preg_replace('/[^\p{L}\p{N}\s]/u', ' ', str_replace(['&','+'],'and',$category->name))))),'-'),'UTF-8');
            $category->update(['slug'=>$text,
                         
            ]);
        }

    }
}
