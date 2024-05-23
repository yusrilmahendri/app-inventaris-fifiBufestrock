<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0895602942578',
            'gender' => 'pria',
            'alamat' => 'Pangkalpinang, Bangka'
            ],
            [
                'role' => 'consumer',
                'name' => 'rahman',
                'email' => 'consumer@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '082175084421',
                'gender' => 'pria',
                'alamat' => 'erzys@gmail.com',

            ],
        ]);
    }
}
