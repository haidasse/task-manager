<?php

namespace App\Livewire;

use Livewire\Component;

class TaskBoard extends Component
{
   public $project;

    public function render()
    {
        $tasks = [
            'todo'        => $this->project->tasks()->where('status', 'todo')->get(),
            'in_progress' => $this->project->tasks()->where('status', 'in_progress')->get(),
            'done'        => $this->project->tasks()->where('status', 'done')->get(),
        ];

        return view('livewire.task-board', compact('tasks'));
    }

    public function changeStatus($taskId, $status)
    {
        $task = Task::findOrFail($taskId);
        $task->update(['status' => $status]);
    }
}
