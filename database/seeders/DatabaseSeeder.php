<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'first_name' => "admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => User::ADMIN,
            'status' => true,
        ]);

        User::create([
            'first_name' => "Author",
            'email' => "author@email.com",
            'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => User::AUTHOR,
            'status' => true,
        ]);

        Course::create([
            'name' => 'HSC 2024 ENG',
            'code' => 'HSC_2024',
            'fee' => '6000',
        ]);
        Course::create([
            'name' => 'HSC 2024 BAN',
            'code' => 'HSC_2024',
            'fee' => '6000',
        ]);
    }
}
