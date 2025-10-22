<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                {{ __('Dashboard') }}
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-folder me-1"></i>Projets
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">

            <!-- Statistiques améliorées -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-folder text-primary fs-4"></i>
                            </div>
                            <h3 class="h6 fw-semibold text-muted mb-2">Projets totaux</h3>
                            <p class="h2 fw-bold text-primary mb-0">{{ $totalProjects }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-tasks text-success fs-4"></i>
                            </div>
                            <h3 class="h6 fw-semibold text-muted mb-2">Tâches totales</h3>
                            <p class="h2 fw-bold text-success mb-0">{{ $totalTasks }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                            <h3 class="h6 fw-semibold text-muted mb-2">Tâches à faire</h3>
                            <p class="h2 fw-bold text-warning mb-0">{{ $pendingTasks }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Projets récents amélioré -->
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title fw-semibold mb-0 text-dark">
                                <i class="fas fa-rocket text-primary me-2"></i>
                                Projets récents
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach($projects as $project)
                                    <div class="list-group-item border-0 px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded p-2 me-3">
                                                    <i class="fas fa-folder text-muted"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-semibold">{{ $project->title }}</h6>
                                                    <small class="text-muted">Créé le {{ $project->created_at->format('d/m/Y') }}</small>
                                                </div>
                                            </div>
                                            <span class="badge 
                                                @if($project->status == 'completed') bg-success
                                                @elseif($project->status == 'in_progress') bg-primary
                                                @else bg-warning
                                                @endif">
                                                {{ ucfirst($project->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 py-3">
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm w-100">
                                Voir tous les projets
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tâches par status amélioré -->
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title fw-semibold mb-0 text-dark">
                                <i class="fas fa-list-check text-success me-2"></i>
                                Tâches par statut
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach(['TODO' => ['À faire', 'warning'],
                                     'IN_PROGRESS' => ['En cours', 'primary'],
                                     'DONE' => ['Terminée', 'success']] as $status => [$label, $color])
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-semibold text-{{ $color }} mb-0">
                                            <i class="fas 
                                                @if($status == 'TODO') fa-clock
                                                @elseif($status == 'IN_PROGRESS') fa-spinner
                                                @else fa-check-circle
                                                @endif me-2">
                                            </i>
                                            {{ $label }}
                                        </h6>
                                        <span class="badge bg-{{ $color }} rounded-pill">
                                            {{  isset($tasks[$status]) ? $tasks[$status]->count() : 0 }}
                                        </span>
                                    </div>
                                    
                                    @foreach(($tasks[$status] ?? collect())->take(3) as $task)
                                        <div class="card border mb-2 border-{{ $color }} border-opacity-25">
                                            <div class="card-body py-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <strong class="d-block small">{{ $task->title }}</strong>
                                                        <small class="text-muted">{{ ucfirst($task->priority) }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @if( isset($tasks[$status]) ? $tasks[$status]->count() : 0)
                                        <div class="text-center mt-2">
                                            <small class="text-muted">
                                                +{{ ($tasks[$status]->count() ?? 0) - 3 }} autres tâches
                                            </small>
                                        </div>
                                    @endif
                                </div>
                                
                                @if(!$loop->last)
                                    <hr class="my-3">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
