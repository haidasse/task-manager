<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class TaskBoard extends Component
{
    public Project $project;

    protected $listeners = ['taskUpdated' => '$refresh'];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function changeStatus($taskId, $status)
    {
        $task = $this->project->tasks()->find($taskId);

        if (!$task) {
            session()->flash('error', 'Tâche non trouvée.');
            return;
        }

        $task->update(['status' => $status]);
        $this->dispatch('task-updated');
    }

    public function render()
    {
        $tasksByStatus = [
            'TODO'        => $this->project->tasks()->where('status', 'TODO')->get(),
            'IN_PROGRESS' => $this->project->tasks()->where('status', 'IN_PROGRESS')->get(),
            'DONE'        => $this->project->tasks()->where('status', 'DONE')->get(),
        ];

        return view('livewire.task-board', [
            'tasksByStatus' => $tasksByStatus
        ]);
    }
}
