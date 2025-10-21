<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="card-title fw-semibold mb-0 text-dark">
            <i class="fas fa-plus-circle text-success me-2"></i>
            Ajout Rapide de Tâche
        </h6>
    </div>
    <div class="card-body">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form wire:submit.prevent="addTask">
            <div class="row g-3 align-items-end">
                <!-- Titre de la tâche -->
                <div class="col-12 col-md-5">
                    <label class="form-label fw-medium">Titre de la tâche</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           wire:model="title" 
                           placeholder="Entrez le titre de la tâche..."
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Priorité -->
                <div class="col-12 col-md-3">
                    <label class="form-label fw-medium">Priorité</label>
                    <select class="form-select @error('priority') is-invalid @enderror" 
                            wire:model="priority">
                        <option value="low">🟢 Basse</option>
                        <option value="medium">🟡 Moyenne</option>
                        <option value="high">🔴 Haute</option>
                    </select>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Assignation -->
                <div class="col-12 col-md-3">
                    <label class="form-label fw-medium">Assigner à</label>
                    <select class="form-select @error('assigned_to') is-invalid @enderror" 
                            wire:model="assigned_to">
                        <option value="">👤 Non assigné</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('assigned_to')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Bouton d'ajout -->
                <div class="col-12 col-md-1">
                    <button type="submit" class="btn btn-success w-100" title="Ajouter la tâche">
                        <i class="fas fa-plus">ajouter</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
