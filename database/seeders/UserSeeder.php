<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            0 => [
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'admin@gmail.com',
            'role_id'=> 1
            ],
            1 => [
                'name' => 'direktur',
                'username' => 'direktur',
                'password' => Hash::make('password'),
                'email' => 'direktur@gmail.com',
                'role_id'=> 2
            ],

            2 => [
                'name' => 'Akunting',
                'username' => 'accounting',
                'password' => Hash::make('password'),
                'email' => 'accounting@gmail.com',
                'role_id'=> 3
            ],
        ]);
    }
}
