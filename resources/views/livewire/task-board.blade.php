<div class="row">
    @foreach(['TODO' => 'À faire', 'IN_PROGRESS' => 'En cours', 'DONE' => 'Terminée'] as $status => $label)
        <div class="col-12 col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-bold">{{ $label }} ({{ $tasksByStatus[$status]->count() }})</div>
                <div class="card-body" style="min-height: 150px;">
                    @foreach($tasksByStatus[$status] as $task)
                        <div class="border p-2 mb-2 rounded bg-white d-flex justify-content-between align-items-center">
                            {{ $task->title }}
                            <select class="form-select form-select-sm w-auto" wire:change="changeStatus({{ $task->id }}, $event.target.value)">
                                <option value="todo" @selected($task->status == 'TODO')>À faire</option>
                                <option value="in_progress" @selected($task->status == 'IN_PROGRESS')>En cours</option>
                                <option value="done" @selected($task->status == 'DONE')>Terminée</option>
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>