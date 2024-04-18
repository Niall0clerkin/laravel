<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $notes = Note::where('user_id', $userId)
            ->latest('updated_at')
            ->paginate(3);

        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
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

        return redirect()->route('notes.index')->with('success', 'Note added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('notes.show')->with('note', $note);
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

        return view('notes.edit')->with(['note' => $note]);
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
            'image_path' => 'url',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',
            'category' => 'required', // Validate that category is required
        ]);

        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->image_path = $request->input('image_path');
        $note->time_to_read = $request->input('time_to_read');
        $note->is_published = $request->has('is_published') ? 1 : 0;
        $note->priority = $request->input('priority');
        $note->category = $request->input('category'); // Update category from the request
        $note->save(); // Save the updated note

        return redirect()->route('notes.show', $note)->with('success', 'Note updated successfully');
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

    return redirect()->route('notes.index')->with('success', 'Note deleted successfully');
}
}
