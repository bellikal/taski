<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// General routes
Route::get('/', [HomeController::class, 'index'])->name('home'); // Homepage

// Authentication-dependent routes
Route::middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->middleware('verified')->name('dashboard'); // Dashboard for authenticated users

    // Task-related routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); // List all tasks
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Form to create a new task
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Store a new task
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Form to edit a task
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Update a task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Delete a task
    Route::post('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus'); // Update task status
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show'); // View task details

    // Comment routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); // Store a new comment

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Form to edit user profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update user profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete user profile
});

// Static pages
Route::get('/about', [PageController::class, 'about'])->name('about'); // About us page
Route::get('/contact', [PageController::class, 'contact'])->name('contact'); // Contact page
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send'); // Process contact form submission

require __DIR__ . '/auth.php'; // Authentication routes
