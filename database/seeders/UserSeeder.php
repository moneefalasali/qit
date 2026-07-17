<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        \App\Models\User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@qitaf.com',
            'password' => bcrypt('password123'),
            'phone' => '+966501234567',
            'role' => 'admin',
        ]);

        // Create test farmers
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\User::create([
                'name' => 'مزارع ' . $i,
                'email' => 'farmer' . $i . '@qitaf.com',
                'password' => bcrypt('password123'),
                'phone' => '+96650' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'role' => 'farmer',
            ]);
        }

        // Create test workers
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\User::create([
                'name' => 'عامل ' . $i,
                'email' => 'worker' . $i . '@qitaf.com',
                'password' => bcrypt('password123'),
                'phone' => '+96650' . str_pad($i + 100, 7, '0', STR_PAD_LEFT),
                'role' => 'worker',
            ]);
        }
    }
}
