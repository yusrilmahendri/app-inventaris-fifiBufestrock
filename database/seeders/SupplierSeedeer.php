<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Consumer;

class SupplierSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consumer = Consumer::inRandomOrder()->first()->id;
        DB::table('suppliers')->insert([
            [
            'consumer_id' =>  $consumer,
            'name' => 'rohim',
            'email' => 'rohim@gmail.com',
            'phone' => '0895602942578',
            'gender' => 'pria',
            'alamat' => 'Pangkalpinang, Sungailiat'
            ],
        ]);
    }
}
