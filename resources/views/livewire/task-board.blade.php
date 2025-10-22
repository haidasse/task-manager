<div class="row">
    @foreach(['TODO' => 'À faire', 'IN_PROGRESS' => 'En cours', 'DONE' => 'Terminée'] as $status => $label)
    <div class="col-12 col-md-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-{{ $status == 'TODO' ? 'warning' : ($status == 'IN_PROGRESS' ? 'primary' : 'success') }} bg-opacity-10 border-0 py-3">
                <h6 class="card-title fw-bold text-{{ $status == 'TODO' ? 'warning' : ($status == 'IN_PROGRESS' ? 'primary' : 'success') }} mb-0">
                    <i class="fas
                            @if($status == 'TODO') fa-clock
                            @elseif($status == 'IN_PROGRESS') fa-spinner
                            @else fa-check-circle
                            @endif me-2">
                    </i>
                    {{ $label }}
                    <span class="badge bg-{{ $status == 'TODO' ? 'warning' : ($status == 'IN_PROGRESS' ? 'primary' : 'success') }} rounded-pill ms-2">
                        {{ $tasksByStatus[$status]->count() }}
                    </span>
                </h6>
            </div>
            <div class="card-body" style="min-height: 200px;">
                @foreach($tasksByStatus[$status] as $task)
                <div class="card border-start border-{{ $status == 'TODO' ? 'warning' : ($status == 'IN_PROGRESS' ? 'primary' : 'success') }} border-3 shadow-sm mb-2">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1 me-2">
                                <strong class="d-block">{{ $task->title }}</strong>
                                @if($task->description)
                                <small class="text-muted d-block mt-1">
                                    {{ Str::limit($task->description, 50) }}
                                </small>
                                @endif
                                <div class="d-flex gap-2 mt-2">
                                    <span class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'success') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                    @if($task->assigned_to)
                                    <span class="badge bg-info">
                                        <i class="fas fa-user me-1"></i>
                                        {{ $task->assignedUser->name ?? 'Assigné' }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @can('update', $task)
                            <select class="form-select form-select-sm w-auto"
                            wire:change="changeStatus({{ $task->id }}, $event.target.value)"
                            style="min-width: 120px;">
                            <option value="TODO" @selected($task->status == 'TODO')>À faire</option>
                            <option value="IN_PROGRESS" @selected($task->status == 'IN_PROGRESS')>En cours</option>
                            <option value="DONE" @selected($task->status == 'DONE')>Terminée</option>
                        </select>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm" title="Modifier la tâche">
                                    <i class="fas fa-edit me-1"></i>Modifier
                                </a>
                            @endcan
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @can('delete', $task)
                        <div class="card-footer bg-white border-0 pt-0">

                        <div class="d-flex justify-content-end">
                           <button class="dropdown-item text-danger"
                                onclick="confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?') || event.stopImmediatePropagation()"
                                wire:click="deleteTask({{ $task->id }})">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                         </div>
                        </div>
                        @endcan
                    </div>
                    </div>
                </div>
                @endforeach

                @if($tasksByStatus[$status]->isEmpty())
                <div class="text-center text-muted py-4">
                    <i class="fas fa-tasks fa-2x mb-2"></i>
                    <p class="small mb-0">Aucune tâche</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>