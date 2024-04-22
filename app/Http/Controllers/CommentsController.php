<?php 

namespace App\Http\Controllers;



use App\Models\Comment;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Note $note)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id(); // Assign the ID of the authenticated user
        $comment->note_id = $note->id;
        $comment->content = $request->content;
        $comment->save();

        return back()->with('success', 'Comment added successfully');
    }
    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if the authenticated user is authorized to delete the comment
        if ($comment->user_id !== auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this comment');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
