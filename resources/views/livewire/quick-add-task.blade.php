   <div>
    <form wire:submit.prevent="addTask">
        <div class="input-group mb-3">
            <input wire:model="title" type="text" class="form-control" placeholder="Nouvelle tâche...">
            <button class="btn btn-primary">Ajouter</button>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
</div>
