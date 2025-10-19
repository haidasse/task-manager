<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Liste les projets de l'utilisateur
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->latest()
            ->paginate(6);

        return view('projects.index', compact('projects'));
    }

    // Formulaire de création
    public function create()
    {
        return view('projects.create');
    }

    // Stocke un nouveau projet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,completed,archived'
        ]);

        $validated['user_id'] = Auth::id();

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    // Affiche un projet
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('projects.show', compact('project'));
    }

    // Formulaire d'édition
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    // Met à jour un projet
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,archived',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour.');
    }

    // Supprime un projet
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé.');
    }
}
