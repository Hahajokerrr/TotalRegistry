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
        \App\Models\User::factory()->create([
            'name'=>"Test user",
            'email'=>"test@gmail.com",
            'password' => "password",
            'is_admin' => true
        ]);

        // \App\Models\User::factory()->create([
        //     'name'=>"Test user",
        //     'email'=>"test1@gmail.com",
        //     'password' => "password",
        // ]);

        // \App\Models\Listing::factory(2)->create([
        //     'by_user_id' => 1
        // ]);
        // \App\Models\Listing::factory(10)->create([
        //     'by_user_id' => 2
        // ]);
    }
}
