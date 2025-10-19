<?php

namespace App\Livewire;

use Livewire\Component;

class QuickAddTask extends Component
{
  public $project;
    public $title;

    public function addTask()
    {
        $this->validate(['title' => 'required|string|max:255']);

        Task::create([
            'title' => $this->title,
            'project_id' => $this->project->id,
            'status' => 'todo',
            'priority' => 'medium'
        ]);

        $this->reset('title');
        session()->flash('success', 'Tâche ajoutée !');
        $this->dispatch('taskAdded');
    }

    public function render()
    {
        return view('livewire.quick-add-task');
    }
}
