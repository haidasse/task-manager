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

    // Liste des projets du user
    public function index(Request $request)
    {
        $query = Project::where('user_id', Auth::id());

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $projects = $query->latest()->paginate(6);

        return view('projects.index', compact('projects'));
    }

    // Formulaire création projet
    public function create()
    {
        return view('projects.create');
    }

    // Stocker projet
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,archived',
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    // Afficher un projet
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        return view('projects.show', compact('project'));
    }

    // Formulaire édition
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    // Mise à jour
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,archived',
        ]);

        $project->update($request->only('title', 'description', 'status'));

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour.');
    }

    // Supprimer
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé.');
    }
}
