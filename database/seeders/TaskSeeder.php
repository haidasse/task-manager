<?php

namespace Database\Seeders;

use App\Constants\Constant;
use App\Models\Task;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Task::factory()->create([
                'project_id'  => rand(1, 5),
                'title'       => 'Task for ...',
                'description' => 'Description for task ...',
                'priority'    => Constant::TASK_PRIORITIES[array_rand(Constant::TASK_PRIORITIES)],
                'status'      => Constant::TASK_STATUSES[array_rand(Constant::TASK_STATUSES)],
                'assigned_to' => null,
            ]);
        }
    }
}
