<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VacanciesController extends Controller
{
    
   

public function indexUser()
{
    // Get the authenticated user
    $user = Auth::user();

    // Fetch notes associated with the authenticated user
    $notes = Note::where('user_id', $user->id)->paginate(10);

    // Return the view with the notes
    return view('vacancies.indexuser')->with('notes', $notes);
}


public function deletedIndex()
{
    // Get the authenticated user
    $user = Auth::user();

    // Fetch deleted notes associated with the authenticated user
    $deletedNotes = Note::where('user_id', $user->id)
                        ->where('deleted', true)
                        ->get();

    return view('vacancies.deletedindex', compact('deletedNotes'));
}






public function index()
{
    $notes = Note::paginate(10);
   



    return view('vacancies.index', compact('notes'));
}





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:notes|max:255',
            'body' => 'required',
            'image_path' => 'url',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',
            'category' => 'required', // Validate that category is required
        ]);

        $note = new Note(); // Create a new instance of the Note model
        $note->user_id = $request->user()->id;
        $note->title = $request->title;
        $note->body = $request->body;
        $note->image_path = $request->image_path;
        $note->time_to_read = $request->time_to_read;
        $note->is_published = $request->has('is_published') ? 1 : 0;
        $note->priority = $request->priority;
        $note->category = $request->category; // Assign category from the request
        $note->save(); // Save the note

        return redirect()->route('vacancies.index')->with('success', 'Note added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $note = Note::findOrFail($id);
    $isDeleted = $note->deleted;
  

    return view('vacancies.show', compact('note', 'isDeleted'));
}


public function reupload($id)
{
    $note = Note::findOrFail($id);

    // Update the 'deleted' field to false to mark the note as not deleted
    $note->deleted = false;
    $note->save();

    return Redirect::route('vacancies.show', $note->id)->with('success', 'Note re-uploaded successfully');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $note = Note::findOrFail($id);
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }

        return view('vacancies.edit')->with(['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);
    
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }
    
        $request->validate([
            'title' => 'required|max:255|unique:notes,title,'.$id,
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for the image
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',
            'category' => 'required', // Validate that category is required
        ]);
    
        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->time_to_read = $request->input('time_to_read');
        $note->is_published = $request->has('is_published') ? 1 : 0;
        $note->priority = $request->input('priority');
        $note->category = $request->input('category');
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $note->image_path = 'images/' . $imageName;
        }
    
        $note->save(); // Save the updated note
    
        return redirect()->route('vacancies.show', $note)->with('success', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        // Update the 'deleted' field to true
        $note->deleted = true;
        $note->save();

        return redirect()->route('vacancies.index')->with('success', 'Note deleted successfully');
    }


public function addComment(Request $request, Note $note)
{
    // Validation for comment creation

    // Create the comment
    $comment = $note->comments()->create([
        'user_id' => $request->user()->id,
        'body' => $request->body,
    ]);

    return back()->with('success', 'Comment added successfully');
}
}
