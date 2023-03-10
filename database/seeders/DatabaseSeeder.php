<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(CurrencySeeder::class);
        $this->call(OperationSeeder::class);
        $this->call(RemainderDaySeeder::class);
    }
}
