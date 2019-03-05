<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->updateOrInsert([
            ['price_range' => '200'],
        ]);
    }
}
