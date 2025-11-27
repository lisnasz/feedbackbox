<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user in database
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@feedbackbox.local'],
            [
                'name' => 'Administrator',
                'email' => 'admin@feedbackbox.local',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Optionally create additional admin users
        DB::table('users')->updateOrInsert(
            ['email' => 'superadmin@feedbackbox.local'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@feedbackbox.local',
                'password' => Hash::make('superadmin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info('✅ Admin users created successfully!');
        $this->command->info('');
        $this->command->info('Admin Credentials:');
        $this->command->info('─────────────────────────────────────');
        $this->command->info('Username 1: admin@feedbackbox.local');
        $this->command->info('Password:   admin123');
        $this->command->info('');
        $this->command->info('Username 2: superadmin@feedbackbox.local');
        $this->command->info('Password:   superadmin123');
        $this->command->info('─────────────────────────────────────');
    }
}
