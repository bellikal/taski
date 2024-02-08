<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate inputs
        $validatedData = $request->validate([
            'task_id' => 'required|exists:tasks,id', // Ensure the task ID exists
            'content' => 'required|string', // Ensure content is present and is a string
        ]);
    
        // Create and save a new comment
        $comment = new Comment();
        $comment->task_id = $validatedData['task_id'];
        $comment->user_id = auth()->id(); // Assign the ID of the authenticated user
        $comment->content = $validatedData['content'];
        $comment->save();
    
        // Load the user relationship to get the name of the user for the comment
        $comment->load('user');
    
        // If it's an AJAX request, return a JSON response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'commentId' => $comment->id,
                'commentContent' => $comment->content,
                'userName' => $comment->user->name, // Assuming there's a 'name' field in your User model
                'createdAt' => $comment->created_at->format('d.m.Y H:i'), // Formatting the creation date
            ]);
        }
    
        // If not an AJAX request, redirect back or to a default route
        return back();
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
}
