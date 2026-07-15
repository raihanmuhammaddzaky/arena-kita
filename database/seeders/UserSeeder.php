<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin ArenaKita',
            'email' => 'admin@arenakita.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role' => 'admin',
            'status' => 'approved',
        ]);

        User::create([
            'name' => 'Budi Setiawan (Renter)',
            'email' => 'renter@arenakita.com',
            'password' => Hash::make('password'),
            'phone' => '081298765432',
            'role' => 'renter',
            'status' => 'approved',
        ]);
        
        User::create([
            'name' => 'Jane Doe (Pending)',
            'email' => 'pending@example.com',
            'password' => Hash::make('password'),
            'phone' => '081298765433',
            'role' => 'renter',
            'status' => 'pending',
        ]);
    }
}
