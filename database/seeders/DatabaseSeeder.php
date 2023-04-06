<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@a.a',
            'password' => Hash::make('admin')
        ]);

        $this->call(CurrencySeeder::class);
        $this->call(OperationSeeder::class);
        $this->call(RemainderDaySeeder::class);
    }
}
