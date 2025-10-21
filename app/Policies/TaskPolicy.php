<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{

    public function view(User $user, Task $task): bool
    {
        $project = Project::find($task->project_id);

        return $user->id === $project->user_id || $user->id === $task->assigned_to;
    }

    public function create(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    public function update(User $user, Task $task)
    {
        $project = Project::find($task->project_id);

        return $user->id === $project->user_id || $user->id === $task->assigned_to;
    }

    public function delete(User $user, Task $task)
    {
       $project = Project::find($task->project_id);

        return $user->id === $project->user_id;
    }
}
