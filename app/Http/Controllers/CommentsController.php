<?php 

namespace App\Http\Controllers;



use App\Models\Comment;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
   
    public function store(Request $request, Note $note)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->note_id = $note->id;
        $comment->content = $request->content;
        $comment->save();

        return back()->with('success', 'Comment added successfully');
    }
   
    
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this comment');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
