<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         if (env('APP_ENV') !== 'production') {
             User::factory(10)->create();
             Album::factory(10)->create();
         }

         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'email_verified_at' => now(),
             'password' => Hash::make('password'),
         ]);
    }
}
