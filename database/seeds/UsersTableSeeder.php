<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'account' => 'Hao',
            'name' => 'Hao',
            'email' => 'howhow926@gmail.com',
            'password' => Hash::make('123123'),
            'department_id' => 1,
            'api_token' => str_random(64)
        ]);

        User::create([
            'account' => 'Tone',
            'name' => 'Tone',
            'email' => 'tone@gmail.com',
            'password' => Hash::make('123123'),
            'department_id' => 1,
            'api_token' => str_random(64)
        ]);
    }
}