<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Constants\Constant;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        // Statistiques
        $totalProjects = Project::where('user_id', $userId)->count();
        $totalTasks = Task::whereHas('project', fn($q) => $q->where('user_id', $userId))->count();
        $pendingTasks = Task::whereHas('project', fn($q) => $q->where('user_id', $userId))
                            ->where('status', Constant::TASK_STATUS_TODO)
                            ->count();

        // Projets récents
        $projects = Project::where('user_id', $userId)->latest()->take(5)->get();

        // Tâches récentes groupées par status
        $tasks = Task::whereHas('project', fn($q) => $q->where('user_id', $userId))
                    ->latest()
                    ->take(20)
                    ->get()
                    ->groupBy('status');

        return view('dashboard', compact(
            'totalProjects', 'totalTasks', 'pendingTasks', 'projects', 'tasks'
        ));
    }
}
