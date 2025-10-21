<?php

namespace App\Livewire;

use App\Constants\Constant;
use App\Models\Project;
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
        session()->flash('success', 'task created !');
        $this->dispatch('task-added');
    }

    public function render()
    {
        return view('livewire.quick-add-task');
    }
}
