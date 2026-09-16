<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::create([
            'name' => 'Admin Hasan',
            'username' => 'adminhasan',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        // Membuat akun Operator (ini yang akan muncul di tabel kamu)
        User::create([
            'name' => 'Operator Maya',
            'username' => 'mayaop',
            'password' => Hash::make('password123'),
            'role' => 'Operator',
        ]);
    }
}
