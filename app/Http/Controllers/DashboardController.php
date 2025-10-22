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

        $totalProjects = Project::where('user_id', $userId)->count() ?? 0;
        $totalTasks    = Task::whereHas('project', fn($q) => $q->where('user_id', $userId))->count() ?? 0;
        $pendingTasks  = Task::whereHas('project', fn($q) => $q->where('user_id', $userId))
                            ->where('status', Constant::TASK_STATUS_TODO)
                            ->count() ?? 0;

        $projects = Project::where('user_id', $userId)->latest()->take(5)->get();

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
