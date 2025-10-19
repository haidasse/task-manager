<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold">Projets totaux</h3>
                    <p class="mt-2 text-2xl font-bold">{{ $totalProjects }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold">Tâches totales</h3>
                    <p class="mt-2 text-2xl font-bold">{{ $totalTasks }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold">Tâches à faire</h3>
                    <p class="mt-2 text-2xl font-bold">{{ $pendingTasks }}</p>
                </div>
            </div>

            <!-- Projets récents -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Projets récents</h3>
                <ul>
                    @foreach($projects as $project)
                        <li class="border-b py-2">{{ $project->title }} - {{ ucfirst($project->status) }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Tâches par status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(['todo' => 'À faire', 'in_progress' => 'En cours', 'done' => 'Terminée'] as $status => $label)
                    <div class="bg-white shadow rounded-lg p-4">
                        <h5 class="font-semibold mb-3">{{ $label }} ({{ $tasks[$status]->count() ?? 0 }})</h5>
                        @foreach($tasks[$status] ?? [] as $task)
                            <div class="border p-2 mb-2 rounded">
                                <strong>{{ $task->title }}</strong><br>
                                <small class="text-gray-600">{{ ucfirst($task->priority) }}</small>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
