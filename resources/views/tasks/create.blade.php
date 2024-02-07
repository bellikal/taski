@extends('layouts.master')

@section('title', 'Create Task')

@section('content')

{{-- Fehlermeldungen anzeigen --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{-- Durch alle Fehlermeldungen laufen und ausgeben --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    {{-- Container für die Formularkarte --}}
    <div class="container mt-4">
        <div class="card">

            {{-- Kartenkopf mit Titel --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Create New Task</div> {{-- Titel der Erstellungsseite --}}
            </div>

            {{-- Formular zur Erstellung eines neuen Tasks --}}
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="card-body text-dark">

                    {{-- Titel --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    </div>

                    {{-- Beschreibung --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    {{-- Fälligkeitsdatum --}}
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="datetime-local" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
                    </div>   

                    {{-- Prioritätsauswahl --}}
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-control" id="priority" name="priority">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    {{-- Kategorienauswahl --}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category_id">

                            {{-- Durch alle Kategorien gehen und als Optionen ausgeben --}}
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Zurück, erstellen Button --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary">Create Task</button> {{-- Schaltfläche zum Erstellen des Tasks --}}
                </div>
            </form>
        </div>
    </div>
    
@endsection
