<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superAdmin = User::create([
            'name' => 'Kira', 
            'email' => 'kira@example.com',
            'password' => Hash::make('123456789')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Maria', 
            'email' => 'maria@example.com',
            'password' => Hash::make('123456789')

        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Pedro', 
            'email' => 'pedro@example.com',
            'password' => Hash::make('123456789')

        ]);
        $productManager->assignRole('Product Manager');
    }
}
