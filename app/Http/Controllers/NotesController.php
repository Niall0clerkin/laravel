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

        // With the Model for Notes having fillable set we need to ensure

        //that only valid value typres are accepted from the Browser for storing in the dB

        $request->validate([

            'title' => 'required|unique:notes|max:255',
            'body' => 'required',
            'image_path' => 'url',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',

        ]);

        $note = Note::create([

            'user_id' => $request->user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'image_path' => $request->image_path,
            'time_to_read' => $request->time_to_read,
            'is_published' => $request->is_published === 'on' ? '1' : '0',
            'priority' => $request->priority,

        ]);

        return to_route('notes.index')->with('success', 'Note added successfully');

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
        ]);

        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->image_path = $request->input('image_path');
        $note->time_to_read = $request->input('time_to_read');

        if ($request->has('is_published')) {
            $note->is_published = 1;
        } else {
            $note->is_published = 0;
        }

        $note->priority = $request->input('priority');
        $note->update();

        return to_route('notes.show', $note)->with('success', 'Note updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'Remove the Note with id = '.$id;
    }
}
