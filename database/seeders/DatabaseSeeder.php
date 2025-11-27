<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Run admin seeder first
        $this->call(AdminSeeder::class);

        // Run category seeder
        $this->call(CategorySeeder::class);
        
        // Run feedback seeder
        $this->call(FeedbackSeeder::class);

        $this->command->info('');
        $this->command->info('✅ Database seeded successfully!');
    }
}
