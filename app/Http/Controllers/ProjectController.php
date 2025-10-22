<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Project::where(function($q) use ($user) {
            $q->where('user_id', $user->id)
            ->orWhereHas('tasks', function($taskQuery) use ($user) {
                $taskQuery->where('assigned_to', $user->id);
            });
        });

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        $projects = $query->latest()->paginate(6);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,completed,archived',
        ]);

        Project::create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,completed,archived',
        ]);

        $project->update($request->only('title', 'description', 'status'));

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé.');
    }
}
