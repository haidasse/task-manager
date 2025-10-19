<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class); // Policy
        $projects = Project::where('user_id', auth()->id())->get(); // Pour choisir le projet
        $users = User::all(); // Pour assigner
        return view('tasks.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:low,medium,high',
            'status'      => 'required|in:todo,in_progress,done',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['project_id'] = $project->id;

        Task::create($validated);

        return back()->with('success', 'Tâche ajoutée avec succès.');
    }

    public function assign(Task $task)
    {
        $users = User::all();
        return view('tasks.assign', compact('task', 'users'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        return back()->with('success', 'Tâche mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return back()->with('success', 'Tâche supprimée.');
    }
}
