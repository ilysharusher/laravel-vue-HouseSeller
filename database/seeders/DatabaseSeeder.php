<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        User::factory(10)->has(
            Listing::factory(3)
        )->create();
    }
}
