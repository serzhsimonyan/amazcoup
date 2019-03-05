<?php

use App\Models\Promocode;
use Illuminate\Database\Seeder;

class PromocodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $promocodes->each(function($promocode) {
           Promocode::updateOrCreate([
               $promocode
           ]);
        });
    }
}
