@extends('layouts.master')

@section('title', 'Tasks')

@section('content')

    <div class="container mt-4">
        <div class="container mt-4">
            <div class="row justify-content-between align-items-end">
                <!-- Titel und Anzahl der Aufgaben -->
                <div class="col">
                    <h1>My Tasks</h1>
                    <p>Number of open tasks: <strong>{{ $activeTaskCount }}</strong></p>
                </div>
                
                <!-- Create new Task Button -->
                <div class="col-auto mb-3">
                    <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark btn-lg"><i class="fa-solid fa-plus"></i> Create New Task</a>
                </div>
            </div>
        </div>        

        {{-- Tabelle für aktive Aufgaben --}}
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            {{-- Spalten sortierbar --}}
                            <th><a href="{{ route('tasks.index', ['sort' => 'title', 'direction' => request('sort') == 'title' ? $nextDirection : 'asc']) }}">Title <i class="fa-solid fa-sort"></i></a></th>
                            <th><a href="{{ route('tasks.index', ['sort' => 'priority', 'direction' => request('sort') == 'priority' ? $nextDirection : 'asc']) }}">Priority <i class="fa-solid fa-sort"></i></a></th>
                            <th><a href="{{ route('tasks.index', ['sort' => 'status', 'direction' => request('sort') == 'status' ? $nextDirection : 'asc']) }}">Status <i class="fa-solid fa-sort"></i></a></th>
                            <th><a href="{{ route('tasks.index', ['sort' => 'due_date', 'direction' => request('sort') == 'due_date' ? $nextDirection : 'asc']) }}">Due <i class="fa-solid fa-sort"></i></a></th>
                            <th><a href="{{ route('tasks.index', ['sort' => 'category_name', 'direction' => request('sort') == 'category_name' ? $nextDirection : 'asc']) }}">Categories <i class="fa-solid fa-sort"></i></a></th>
                            <th></th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activeTasks as $task)
                            <tr>
                                {{-- Titel --}}
                                <td>{{ $task->title }}</td>

                                {{-- Priorität --}}
                                <td>{{ $task->priority }}</td>

                                {{-- Status --}}
                                <td>
                                    {{-- Formular zur Statusaktualisierung --}}
                                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST"
                                        onsubmit="return confirmUpdateStatus();" class="status">
                                        @csrf
                                        <select name="status" class="form-control" id="status_{{ $task->id }}">
                                            @foreach (['open', 'in_progress', 'completed'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ $task->status === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-floppy-disk"></i></button>
                                    </form>
                                </td>

                                {{-- Fälligkeitsdatum --}}
                                <td>{{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }}</td>

                                {{-- Kategorie --}}
                                <td>{{ $task->category ? $task->category->name : 'No Category' }}</td>

                                {{-- Kommentare --}}
                                <td>{{ $task->comments->count() }} comments</td>

                                {{-- Bearbeiten --}}
                                <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary text-light"><i class="fa-solid fa-pen"></i></a></td>
                                
                                {{-- Löschen --}}
                                <td>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>

                                {{-- Detailansicht --}}
                                <td><a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> show</a></td>
                            </tr>
                            @empty
                            <tr>
                                {{-- WEnn keine Tasks vorhanden --}}
                                <td colspan="8" class="text-center">You have no active tasks!</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabelle für abgeschlossene Aufgaben --}}
        <div>
            <h3 class="mt-4">Completed Tasks</h3>
            <p>Number of completed tasks: <strong>{{ $completedTaskCount }}</strong></p>
            <div class="card mt-3 completed-section">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="text-muted">
                                <th>Title</th>
                                <th>Categories</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completedTasks as $task)
                                <tr class="text-muted">
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->category ? $task->category->name : 'No Category' }}</td>
                                    <td>{{ $task->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bestätigung vor dem Markieren einer Aufgabe als abgeschlossen
        function confirmUpdateStatus() {
            // Zugriff auf das Select-Element und den ausgewählten Wert
            var selectedStatus = event.target.querySelector('select[name="status"]').value;

            // Nur bestätigen, wenn derr neue Status 'completed' ist
            if (selectedStatus === 'completed') {
                return confirm('Are you sure you want to mark this task as completed?');
            }

            // Keine Bestätigung für andere Statusänderungen
            return true;
        }
    </script>

@endsection
