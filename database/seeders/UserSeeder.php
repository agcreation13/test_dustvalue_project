<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'admin', // Assign the 'admin' role
        ]);

        // Create a Manager user
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'manager', // Assign the 'manager' role
        ]);

        // Create an Employee user
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'employee', // Assign the 'employee' role
        ]);
    }
}