@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

    {{-- Tasks --}}
    <div class="container mt-4">

        {{-- Personal greeting and motivational quote --}}
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>{{ $greeting }}, {{ auth()->user()->name }}!</h1>
                <p>{{ $randomQuote }}</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-lg"><i class="fa-solid fa-list"></i> My Tasks</a>
            </div>
        </div>
    
        {{-- Statistics --}}
        <div class="row">
            {{-- Total tasks statistics --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-light">
                    <h5 class="card-header">All Tasks</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6>All</h6>
                                <p>{{ $totalTasksGlobal }}</p>
                            </div>
                            <div class="col">
                                <h6>Mine</h6>
                                <p>{{ $totalTasksUser }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Open Tasks --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-secondary text-light">
                    <h5 class="card-header">Open Tasks</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6>All</h6>
                                <p>{{ $openTasksGlobal }}</p>
                            </div>
                            <div class="col">
                                <h6>Mine</h6>
                                <p>{{ $openTasksUser }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Tasks in progress --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-warning text-light"">
                    <h5 class="card-header">In progress</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6>All</h6>
                                <p>{{ $inProgressTasksGlobal }}</p>
                            </div>
                            <div class="col">
                                <h6>Mine</h6>
                                <p>{{ $inProgressTasksUser }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Completed Tasks --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-light"">
                    <h5 class="card-header">Completed Tasks</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6>All</h6>
                                <p>{{ $completedTasksGlobal }}</p>
                            </div>
                            <div class="col">
                                <h6>Mine</h6>
                                <p>{{ $completedTasksUser }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tasks Table --}}
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>All active tasks</h2>
                <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark btn-lg"><i class="fa-solid fa-plus"></i> Create New Task</a>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- Columns sortable --}}
                                <th><a href="{{ route('dashboard', ['sort' => 'title', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Title <i class="fa-solid fa-sort"></i></a></th>
                                <th><a href="{{ route('dashboard', ['sort' => 'priority', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Priority <i class="fa-solid fa-sort"></i></a></th>
                                <th><a href="{{ route('dashboard', ['sort' => 'status', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Status <i class="fa-solid fa-sort"></i></a></th>
                                <th><a href="{{ route('dashboard', ['sort' => 'due_date', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Due <i class="fa-solid fa-sort"></i></a></th>
                                <th><a href="{{ route('dashboard', ['sort' => 'category_name', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Categories <i class="fa-solid fa-sort"></i></a></th>
                                <th><a href="{{ route('dashboard', ['sort' => 'user', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">User <i class="fa-solid fa-sort"></i></a></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
            
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    {{-- Title --}}
                                    <td>{{ $task->title }}</td>

                                    {{-- Priority --}}
                                    <td>{{ $task->priority }}</td>

                                    {{-- Status --}}
                                    <td>{{ $task->status }}</td>

                                    {{-- Due date --}}
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }}</td>

                                    {{-- Category --}}
                                    <td>{{ $task->category ? $task->category->name : 'No Category' }}</td>

                                    {{-- User --}}
                                    <td>{{ $task->user->id === auth()->id() ? 'Me' : $task->user->name }}</td> {{-- Prüfen ob der Task-Benutzer aktuell angemeldeter Benutzer ist --}}

                                    {{-- Comments --}}
                                    <td>{{ $task->comments->count() }} comments</td>

                                    {{-- Detail view --}}
                                    <td>
                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> show</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    {{-- If no tasks are available show info --}}
                                    <td colspan="8" class="text-center">No tasks yet!</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
