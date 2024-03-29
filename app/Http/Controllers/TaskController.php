<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = auth()->id(); // ID of the authenticated user
        $sort = $request->get('sort', 'due_date'); // Default sorting by due date
        $direction = $request->get('direction', 'asc'); // Default ascending order

        if ($sort == 'category_name') {
            $activeTasks = Task::with('comments')
                ->where('user_id', $userId)
                ->where('status', '!=', 'completed') // Only tasks that are not completed
                ->leftJoin('categories', 'tasks.category_id', '=', 'categories.id')
                ->orderBy('categories.name', $direction)
                ->select('tasks.*', 'categories.name as category_name')
                ->get();
        } else {
            $activeTasks = Task::with('comments')
                ->where('user_id', $userId)
                ->where('status', '!=', 'completed')
                ->orderBy($sort, $direction)
                ->get();
        }

        $nextDirection = $direction === 'asc' ? 'desc' : 'asc';

        $completedTasks = Task::with('comments')
            ->where('user_id', $userId)
            ->where('status', '=', 'completed')
            ->get();

        $activeTaskCount = $activeTasks->count(); // Count of active tasks
        $completedTaskCount = $completedTasks->count(); // Count of completed tasks

        $showTask = null;
        if ($request->filled('showTask')) {
            $showTask = $request->showTask == session('showTask') ? null : $request->showTask;
            session(['showTask' => $showTask]);
        } else {
            session()->forget('showTask');
        }

        return view('tasks.index', compact('activeTasks', 'completedTasks', 'showTask', 'activeTaskCount', 'completedTaskCount', 'nextDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Get all categories
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validatedData['status'] = 'open'; // Set status field to "open"
        $validatedData['user_id'] = auth()->id(); // Add user_id to validatedData array

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Ensure the latest comments are loaded
        $task->load(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Sort comments by creation date, latest first
        }]);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all(); // Get all categories
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (auth()->id() != $task->user_id) {
            return back()->with('error', 'Unauthorized action. - This is not your Task, you can not edit it!');
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'required|date',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (auth()->id() != $task->user_id) {
            return back()->with('error', 'Unauthorized action. - This is not your task, you can not delete it!');
        }

        $task->delete();
        return redirect()->route('tasks.index');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:open,in_progress,completed',
        ]);

        $task->status = $validatedData['status'];
        $task->save();

        return back();
    }
}
