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
        $request->validate([
            'task_id' => 'required|exists:tasks,id', // Ensure the task ID exists
            'content' => 'required|string', // Ensure content is present and is a string
        ]);

        // Create and save a new comment
        $comment = new Comment();
        $comment->task_id = $request->task_id;
        $comment->user_id = auth()->id(); // Assign the ID of the authenticated user
        $comment->content = $request->content;
        $comment->save();

        // Redirect the user back
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
