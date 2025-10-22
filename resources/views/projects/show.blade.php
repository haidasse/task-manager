<x-app-layout>
    <div class="container-fluid py-4">
        <!-- En-tête du projet -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold text-dark mb-2">{{ $project->title }}</h1>
                        @if($project->description)
                            <p class="text-muted mb-3">{{ $project->description }}</p>
                        @endif
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge
                                @if($project->status === 'active') bg-success
                                @elseif($project->status === 'completed') bg-secondary
                                @else bg-dark
                                @endif fs-6">
                                {{ ucfirst($project->status) }}
                            </span>
                            <span class="text-muted">
                                <i class="fas fa-tasks me-1"></i>
                                {{ $project->tasks_count ?? 0 }} tâches
                            </span>
                            <span class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Créé le {{ $project->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-warning">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Add Task -->
        <div class="row">
            <div class="col-12">
                <livewire:quick-add-task :project="$project" />
            </div>
        </div>

        <!-- Task Board -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title fw-semibold mb-0 text-dark">
                            <i class="fas fa-list-check text-primary me-2"></i>
                            Tableau des Tâches
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <livewire:task-board :project="$project" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>
