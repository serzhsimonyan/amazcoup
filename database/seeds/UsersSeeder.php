<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name'=> 'test',
            'email' => 'test@test.ru',
            'password' =>  Hash::make('12345'),
            'role_id' => 1
        ]);
    }
}
