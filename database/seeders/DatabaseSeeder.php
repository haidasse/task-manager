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
        User::factory()->create([
            'name'     => 'Test 1',
            'email'    => 'user-1@email.com',
            'password' => bcrypt('Password1'),
        ]);

        User::factory()->create([
            'name'     => 'Test 2',
            'email'    => 'user-2@email.com',
            'password' => bcrypt('Password2'),

        ]);

        User::factory()->create([
            'name'     => 'Test 3',
            'email'    => 'user-3@email.com',
            'password' => bcrypt('Password3'),
        ]);

        $this->call([
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
