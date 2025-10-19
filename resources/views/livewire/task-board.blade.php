<div class="row">
    @foreach(['todo' => 'À faire', 'in_progress' => 'En cours', 'done' => 'Terminée'] as $status => $label)
        <div class="col-md-4">
            <h5>{{ $label }} ({{ $tasks[$status]->count() }})</h5>
            @foreach($tasks[$status] as $task)
                <div class="card mb-2 p-2">
                    <strong>{{ $task->title }}</strong><br>
                    <small>{{ ucfirst($task->priority) }}</small>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
