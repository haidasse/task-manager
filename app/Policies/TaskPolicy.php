<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
public function create(User $user, Project $project)
    {
        // Tous les membres du projet peuvent créer une tâche
        return $user->id === $project->user_id; // ou ajouter membres via pivot si besoin
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->project->user_id || $user->id === $task->assigned_to;
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->project->user_id;
    }
}
