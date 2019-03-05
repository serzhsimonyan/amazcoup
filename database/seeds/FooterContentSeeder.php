<?php

use Illuminate\Database\Seeder;

class FooterContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_id = [
            1,2,3,4,5,6,7,8
        ];

        foreach($categories_id as $category_id) {
            \App\Models\Category::find($category_id)->update(['footer_show'=>1]);
        }
    }
}
