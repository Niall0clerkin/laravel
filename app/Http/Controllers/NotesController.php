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
return view('notes.index')->with('notes',$notes);
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
return "Want to Store the new Note ";
}

/**

* Display the specified resource.

*/

public function show(string $id)
{
$note = Note::where('id',$id)
->where('user_id',Auth::id())
->firstOrFail();
return view('notes.show')->with('note', $note);
}

/**

* Show the form for editing the specified resource.

*/

public function edit(string $id)

{
$note = Note::findOrFail($id);
if($note->user_id != Auth::id()) {
return abort(403);
}
return view('notes.edit')->with(['note' => $note]);
}

/**

* Update the specified resource in storage.

*/

public function update(Request $request, string $id)
{
return "Want to Update Note " . $id;
}

/**

* Remove the specified resource from storage.

*/

public function destroy(string $id)
{
return "Remove the Note with id = " . $id;
}

}
