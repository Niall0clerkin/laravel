<?php

namespace Database\Seeders;

use App\Models\Note;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;

class NotesSeederJSON extends Seeder

{

/**

* Run the database seeds.

*/

public function run(): void

{

Note::truncate();

$json = File::get("database/data/notes.json");

$note = json_decode($json);

$note_id = 1;

foreach ($note as $key => $value) {

Note::create([

"user_id" => $value->user_id,

"title" => $value->title,

"body" => $value->body,

"image_path" => $value->image_path,

"time_to_read" => $value->time_to_read,

"is_published" => $value->is_published,

"priority" => $value->priority,

]

);

$this->command->info($note_id.' Seeded and allocated to User:' . $value->user_id);

$note_id++;

}

}

}
