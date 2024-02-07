@extends('layouts.master')

@section('title', 'Home')

@section('content')

    {{-- Welcome Message --}}
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <h1>Welcome to Taski!</h1>
                <p>Manage your tasks efficiently and stay organized.</p>
            </div>
        </div>

        {{-- Features and Benefits of the Application --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Task Management</h5>
                        <p class="card-text">Create, edit, and track your tasks in a user-friendly interface.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Collaboration</h5>
                        <p class="card-text">Comment on tasks and collaborate with others to advance projects.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <p class="card-text">Keep track of your tasks with useful statistics and charts.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Login or Register Option --}}
        <div class="row justify-content-center align-items-center">
            <div class="col text-center mt-4">
                <h3 class="mt-4 mb-4">To access the full features of the application, please sign in or register now.</h3>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
            </div>
        </div>
        
    </div>

@endsection
