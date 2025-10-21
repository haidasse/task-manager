<x-app-layout>

<div class="container">
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>
    <span class="badge 
        @if($project->status === 'active') bg-success
        @elseif($project->status === 'completed') bg-secondary
        @else bg-dark
        @endif">
        {{ ucfirst($project->status) }}
    </span>

    <hr>

    <!-- Quick Add Task -->
    <livewire:quick-add-task :project="$project" />

    <!-- Task Board -->
    <livewire:task-board :project="$project" />
</div>
</x-app-layout>
