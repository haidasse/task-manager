<x-app-layout>

<div class="container">
    <h1 class="mb-4">Mes Projets</h1>

    <div class="mb-3">
        <a href="{{ route('projects.create') }}" class="btn btn-success">Créer un projet</a>
    </div>

    <!-- Filtres par statut -->
    <div class="mb-3">
        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm">Tous</a>
        <a href="{{ route('projects.index', ['status' => 'active']) }}" class="btn btn-outline-success btn-sm">Active</a>
        <a href="{{ route('projects.index', ['status' => 'completed']) }}" class="btn btn-outline-secondary btn-sm">Completed</a>
        <a href="{{ route('projects.index', ['status' => 'archived']) }}" class="btn btn-outline-dark btn-sm">Archived</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($projects as $project)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                        <span class="badge 
                            @if($project->status === 'active') bg-success
                            @elseif($project->status === 'completed') bg-secondary
                            @else bg-dark
                            @endif">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary btn-sm">Voir</a>

                        <div>
                            @can('update', $project)
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Modifier</a>
                            @endcan

                            @can('delete', $project)
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Supprimer ce projet ?')">Supprimer</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun projet trouvé.</p>
        @endforelse
    </div>

    {{ $projects->withQueryString()->links() }}
</div>
</x-app-layout>
