<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([

            AdminTableSeeder::class,
            ConsumerSeeder::class,
            // SupplierSeedeer::class,

            // BufferStockSeeder::class
            // LeadTimeSeeder::class,
            // ProductSeeder::class,
       ]);
    }
}
