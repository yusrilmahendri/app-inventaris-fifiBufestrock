<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ConsumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'consumer')->inRandomOrder()->first()->id;
        DB::table('consumers')->insert([
            [
                'user_id' => $user,
                'name' => 'hanif abdillah',
                'email' => 'hanif@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '0895602942578',
                'gender' => 'pria',
                'alamat' => 'Magelang, Jawa Tengah'
            ],
        ]);

    }
}
