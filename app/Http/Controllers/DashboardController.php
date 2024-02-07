<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['user', 'comments'])->get();
        
        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display the dashboard with task statistics and quotes.
     */
    public function dashboard(Request $request)
    {
        $sort = $request->get('sort', 'due_date');
        $direction = $request->get('direction', 'asc');
    
        // Task lists and sorting logic
        $tasks = Task::with(['user', 'comments', 'category'])
                    ->join('users', 'tasks.user_id', '=', 'users.id')
                    ->leftJoin('categories', 'tasks.category_id', '=', 'categories.id')
                    ->select('tasks.*', 'users.name as user_name', 'categories.name as category_name')
                    ->where(function($query) {
                        $query->where('tasks.status', '=', 'open')
                              ->orWhere('tasks.status', '=', 'in_progress');
                    })
                    ->orderBy($sort === 'user' ? 'users.name' : ($sort === 'category_name' ? 'categories.name' : 'tasks.'.$sort), $direction)
                    ->get();

        // Calculation of global and personal statistics
        $totalTasksGlobal = Task::count();
        $openTasksGlobal = Task::where('status', 'open')->count();
        $inProgressTasksGlobal = Task::where('status', 'in_progress')->count();
        $completedTasksGlobal = Task::where('status', 'completed')->count();
    
        $userId = auth()->id();
        $totalTasksUser = Task::where('user_id', $userId)->count();
        $openTasksUser = Task::where('user_id', $userId)->where('status', 'open')->count();
        $inProgressTasksUser = Task::where('user_id', $userId)->where('status', 'in_progress')->count();
        $completedTasksUser = Task::where('user_id', $userId)->where('status', 'completed')->count();

        // Motivational quotes
        $quotes = [
            "The road to success is always 'under construction'.",
            "There are no shortcuts to any place worth going.",
            "Progress, not perfection.",
            "Small progress is still progress.",
            "The best time to plant a tree was 20 years ago. The second best time is now.",
            "Don't watch the clock; do what it does. Keep going.",
            "Hardships often prepare ordinary people for an extraordinary destiny.",
            "Believe you can and you're halfway there.",
            "You miss 100% of the shots you don't take.",
            "Success is not final, failure is not fatal: It is the courage to continue that counts.",
            "It does not matter how slowly you go as long as you do not stop.",
            "Our greatest glory is not in never falling, but in rising every time we fall.",
            "Everything you’ve ever wanted is on the other side of fear.",
            "The only limit to our realization of tomorrow will be our doubts of today.",
            "What you get by achieving your goals is not as important as what you become by achieving your goals."
        ];
        
        $randomQuote = $quotes[array_rand($quotes)];

        // Greeting based on time of day
        $hour = date('G');
        if ($hour < 12) {
            $greeting = "Good Morning";
        } elseif ($hour < 18) {
            $greeting = "Good Afternoon";
        } else {
            $greeting = "Good Evening";
        }

        return view('dashboard', compact(
            'tasks', 'sort', 'direction',
            'totalTasksGlobal', 'openTasksGlobal', 'inProgressTasksGlobal', 'completedTasksGlobal',
            'totalTasksUser', 'openTasksUser', 'inProgressTasksUser', 'completedTasksUser',
            'randomQuote', 'greeting'
        ));
         
    }    
    
}
