<?php

namespace Database\Factories;

use App\Constants\Constant;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'project_id'  => 1,
            'title'       => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'priority'    => Constant::TASK_PRIORITY_MEDIUM,
            'status'      => Constant::TASK_STATUS_TODO,
            'assigned_to' => null,
        ];
    }
}
