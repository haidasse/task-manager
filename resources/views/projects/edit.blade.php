
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le Projet</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select">
                <option value="active" {{ old('status', $project->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="archived" {{ old('status', $project->status) === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
