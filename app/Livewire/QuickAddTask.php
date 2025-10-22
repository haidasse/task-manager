<?php

namespace App\Livewire;

use App\Constants\Constant;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class QuickAddTask extends Component
{
    public $project;
    public $title;
    public $priority = Constant::TASK_PRIORITY_LOW;
    public $assigned_to;

    protected $listeners = [
        'task-added' => 'refreshTasks'
    ];

    protected $rules = [
        'title'       => 'required|string|max:255',
        'priority'    => 'required|in:low,medium,high',
        'assigned_to' => 'nullable|exists:users,id',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function addTask()
    {
        $this->validate();

        $this->project->tasks()->create([
            'title'       => $this->title,
            'priority'    => $this->priority,
            'assigned_to' => $this->assigned_to,
            'status'      => 'TODO'
        ]);

        $this->reset(['title', 'priority', 'assigned_to']);
        $this->dispatch('task-added');
        session()->flash('success', 'Tâche créée avec succès !');
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        
        return view('livewire.quick-add-task', compact('users'));
    }
}
