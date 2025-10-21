<x-app-layout>
    <div class="container py-4">
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 fw-bold text-primary mb-0">
                <i class="fas fa-folder me-2"></i>Mes Projets
            </h1>
            <a href="{{ route('projects.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Créer un projet
            </a>
        </div>

        <!-- Filtres par statut -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-3">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <span class="text-muted fw-medium me-2">Filtrer :</span>
                    <a href="{{ route('projects.index') }}" 
                       class="btn btn-outline-primary btn-sm {{ !request('status') ? 'active' : '' }}">
                        Tous
                    </a>
                    <a href="{{ route('projects.index', ['status' => 'active']) }}" 
                       class="btn btn-outline-success btn-sm {{ request('status') === 'active' ? 'active' : '' }}">
                        Active
                    </a>
                    <a href="{{ route('projects.index', ['status' => 'completed']) }}" 
                       class="btn btn-outline-secondary btn-sm {{ request('status') === 'completed' ? 'active' : '' }}">
                        Completed
                    </a>
                    <a href="{{ route('projects.index', ['status' => 'archived']) }}" 
                       class="btn btn-outline-dark btn-sm {{ request('status') === 'archived' ? 'active' : '' }}">
                        Archived
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($projects as $project)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title fw-bold text-dark">{{ $project->title }}</h5>
                                <span class="badge 
                                    @if($project->status === 'active') bg-success
                                    @elseif($project->status === 'completed') bg-secondary
                                    @else bg-dark
                                    @endif">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                            
                            <p class="card-text text-muted">
                                {{ Str::limit($project->description, 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                            <a href="{{ route('projects.show', $project) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Voir
                            </a>

                            <div class="btn-group">
                                @can('update', $project)
                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"> modifier </i>
                                    </a>
                                @endcan

                                @can('delete', $project)
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Supprimer ce projet ?')">
                                            <i class="fas fa-trash"> suprimer</i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun projet trouvé</h5>
                            <p class="text-muted mb-0">Commencez par créer votre premier projet</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{ $projects->withQueryString()->links() }}
    </div>

    <style>
        .btn-outline-primary.active,
        .btn-outline-success.active,
        .btn-outline-secondary.active,
        .btn-outline-dark.active {
            background-color: var(--bs-btn-color);
            color: white;
        }
        
        .card {
            transition: transform 0.2s ease-in-out;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
    </style>
</x-app-layout>
