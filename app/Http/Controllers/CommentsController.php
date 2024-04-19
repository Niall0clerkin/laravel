<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\note;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, note $note)
{
    $request->validate([
        'content' => 'required',
    ]);

    $comment = new Comment();
    $comment->user_id = $request->user()->id;
    $comment->note_id = $note->id;
    $comment->content = $request->content;
    $comment->save();

    return back()->with('success', 'Comment added successfully');
}
}
