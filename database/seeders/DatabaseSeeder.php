<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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
        // 1. Super Administrador
        User::updateOrCreate(
            ['email' => 'admin@auditpro.com'],
            [
                'name' => 'Super Administrador',
                'password' => Hash::make('password'),
                'role' => UserRole::SUPER_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // 2. Auditor
        User::updateOrCreate(
            ['email' => 'auditor@auditpro.com'],
            [
                'name' => 'Auditor Principal',
                'password' => Hash::make('password'),
                'role' => UserRole::AUDITOR,
                'email_verified_at' => now(),
            ]
        );

        // 3. Usuario Cliente
        User::updateOrCreate(
            ['email' => 'cliente@auditpro.com'],
            [
                'name' => 'Cliente Corporativo',
                'password' => Hash::make('password'),
                'role' => UserRole::CLIENT,
                'email_verified_at' => now(),
            ]
        );
    }
}

