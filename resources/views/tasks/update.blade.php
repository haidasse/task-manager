<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h4 fw-bold mb-0">
                                <i class="fas fa-edit text-warning me-2"></i>
                                Modifier la Tâche
                            </h1>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Retour
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.updateTask', $task) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Titre -->
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Titre de la tâche</label>
                                <input type="text" name="title" id="title" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $task->title) }}"
                                       placeholder="Entrez le titre de la tâche...">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea name="description" id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="4"
                                          placeholder="Décrivez la tâche...">{{ old('description', $task->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Priorité -->
                                <div class="col-md-6 mb-3">
                                    <label for="priority" class="form-label fw-semibold">Priorité</label>
                                    <select name="priority" id="priority" 
                                            class="form-select @error('priority') is-invalid @enderror">
                                        <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>
                                            🟢 Basse
                                        </option>
                                        <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>
                                            🟡 Moyenne
                                        </option>
                                        <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>
                                            🔴 Haute
                                        </option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Statut -->
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label fw-semibold">Statut</label>
                                    <select name="status" id="status" 
                                            class="form-select @error('status') is-invalid @enderror">
                                        <option value="todo" {{ old('status', $task->status) === 'todo' ? 'selected' : '' }}>
                                            ⏳ À faire
                                        </option>
                                        <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>
                                            🔄 En cours
                                        </option>
                                        <option value="done" {{ old('status', $task->status) === 'done' ? 'selected' : '' }}>
                                            ✅ Terminée
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Assignation -->
                            <div class="mb-4">
                                <label for="assigned_to" class="form-label fw-semibold">Assigner à</label>
                                <select name="assigned_to" id="assigned_to" 
                                        class="form-select @error('assigned_to') is-invalid @enderror">
                                    <option value="">👤 Non assigné</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" 
                                                {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @can('delete', $task)
                                        <button type="button" class="btn btn-outline-danger" 
                                                onclick="confirm('Supprimer définitivement cette tâche ?') && document.getElementById('delete-form').submit()">
                                            <i class="fas fa-trash me-1"></i>Supprimer
                                        </button>
                                    @endcan
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Mettre à jour
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Form de suppression -->
                        @can('delete', $task)
                            <form id="delete-form" action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
