@extends('layouts.master')

@section('title', 'Task Details')

@section('content')

<div class="container mt-4 details-comments">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h2>{{ $task->title }}</h2>
                <!-- Task creation date -->
                <small class="text-muted">Created on {{ $task->created_at->format('Y-m-d - H:i') }}</small>
            </div>
            <div>
                {{-- Priority as a colored label --}}
                @php
                    $priorityColor = match($task->priority) {
                        'low' => 'bg-info',
                        'medium' => 'bg-warning',
                        'high' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                @endphp
                <span class="badge {{ $priorityColor }}">{{ ucfirst($task->priority) }}</span>
                {{-- Category --}}
                <span class="badge bg-dark">{{ $task->category->name ?? 'No Category' }}</span>
                {{-- Status --}}
                <span class="badge bg-dark">{{ ucfirst($task->status) }}</span>
            </div>
        </div>
        <div class="card-body text-dark">
            <!-- Task description -->
            <p class="card-text">{{ $task->description }}</p>
            <!-- Task due date -->
            <div class="mb-3">
                <div class="">
                    <strong><span>Due Date: </span></strong>
                    @if ($task->due_date)
                        {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d - H:i') }}
                        ({{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }})
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
            @if(auth()->id() == $task->user_id)
                <div>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary text-light"><i class="fa-solid fa-pen"></i> Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Comment section -->
            <div class="col-md-5">
                <h3>Comments</h3>
                @if ($task->comments->isEmpty())
                    <p>No comments yet.</p>
                @else
                    <div class="list-group">
                        @foreach ($task->comments as $comment)
                            <div class="list-group-item">
                                <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->format('d.m.Y H:i') }}):
                                <p>{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
    
            <!-- Comment form -->
            @if(auth()->check())
            <div class="col-md-5">
                <h3>Add a Comment</h3>
                <form id="commentForm" action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    
</div>

<script>
    document.getElementById('commentForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevents the normal sending of the form

        var formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Create the markup for the new comment
                var newComment = '<div class="list-group-item">' +
                                '<strong>' + data.userName + '</strong> (' + data.createdAt + '):' +
                                '<p>' + data.commentContent + '</p>' +
                                '</div>';

                // Add the new comment at the top of the comment list
                document.querySelector('.list-group').insertAdjacentHTML('afterbegin', newComment);

                // Reset the form
                document.getElementById('commentForm').reset();
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
    

@endsection
