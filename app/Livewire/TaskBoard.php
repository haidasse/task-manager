<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class TaskBoard extends Component
{
    public Project $project;

    public $tasksByStatus = [];

    protected $listeners = ['taskUpdated' => '$refresh', 'taskAdded' => '$refresh'];


    public function mount(Project $project)
    {
        $this->project = $project;
        $this->loadTasks();
    }

    public function changeStatus($taskId, $status)
    {
        $task = $this->project->tasks()->find($taskId);

        if (!$task) {
            session()->flash('error', 'Tâche non trouvée.');
            return;
        }

        $task->update(['status' => $status]);
        $this->loadTasks();
        $event = ['task-updated', 'task-added'];
        $this->dispatch($event);
    }

    public function deleteTask($taskId)
    {
        $task = $this->project->tasks()->find($taskId);


        if ($task && auth()->user()->can('delete', $task)) {
            $task->delete();
            $this->loadTasks();
            session()->flash('success', 'Tâche supprimée avec succès.');
        }
        else {
            session()->flash('error', 'Vous n\'êtes pas autorisé à supprimer cette tâche ou elle est introuvable.');
        }
    }

    protected function loadTasks()
    {
        $this->tasksByStatus = [
            'TODO'        => $this->project->tasks()->where('status', 'TODO')->get(),
            'IN_PROGRESS' => $this->project->tasks()->where('status', 'IN_PROGRESS')->get(),
            'DONE'        => $this->project->tasks()->where('status', 'DONE')->get(),
        ];
    }

    public function render()
    {
        return view('livewire.task-board');
    }
}
