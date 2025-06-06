<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Delete existing test users to avoid duplicates
        User::whereIn('email', ['admin@admin.com', 'user@test.com'])->delete();
        
        // Create admin user with strong password
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin'
        ]);

        // Create test regular user with strong password
        User::create([
            'name' => 'testuser',
            'email' => 'user@test.com',
            'password' => Hash::make('User123!'),
            'role' => 'user'
        ]);

        echo "✅ Admin user: admin@admin.com / Admin123!\n";
        echo "✅ Test user: user@test.com / User123!\n";
    }
}