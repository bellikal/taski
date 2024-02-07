@extends('layouts.master')

@section('title', 'Edit Task')

@section('content')

    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Edit Task</div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            {{-- Bearbeitungsformular --}}
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body text-dark">

                    {{-- Titel --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}">
                    </div>

                    {{-- Beschreibung --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
                    </div>

                    {{-- Fälligkeitsdatum --}}
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="datetime-local" class="form-control" id="due_date" name="due_date" 
                        value="{{ old('due_date', isset($task->due_date) ? $task->due_date->format('Y-m-d\TH:i') : null) }}" required>
                    </div>

                    {{-- Priorität --}}
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-control" id="priority" name="priority">
                            <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    {{-- Kategorie--}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Zurück, speichern oder löschen --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()"><i class="fa-solid fa-trash"></i> Delete</button>
                    </div>
                </div>
            </form>

            {{-- Verstecktes Formular zum Löschen des Tasks --}}
            <form id="delete-task-form" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script>
        // Bestätigung, ob der Task wirklich gelöscht werden soll
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this task?')) {
                document.getElementById('delete-task-form').submit();
            }
        }
    </script>

@endsection
