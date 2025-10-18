<?php

namespace Database\Seeders;

use App\Constants\Constant;
use App\Models\Project;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Project::factory()->create([
                'user_id'     => rand(1, 3),
                'title'       => 'Project by user 1',
                'description' => 'Description for project ',
                'status'      => Constant::PROJECT_STATUSES[array_rand(Constant::PROJECT_STATUSES)],
            ]);
        }
    }
}
