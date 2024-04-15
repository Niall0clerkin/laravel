<?php

namespace Database\Seeders;

use App\Models\Note;

use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder

{

/**

* Run the database seeds.

*/

public function run(): void

{

Note::factory(10)->create();

$notes = [

[

'id'=> 11,
'user_id'=> 2,
'title'=> "Made by me",
'body'=> "Made by me Aut ab occaecati repellat laboriosam. Nihil maxime est est rerum. Sapiente ut molestiae error illum a ut provident omnis.",
'image_path'=> "https://via.placeholder.com/640x480.png/00dd66?text=madeByMe",
'time_to_read'=> 2,
'is_published'=> 1,
'priority'=> 3,
'created_at' => now(),
'updated_at' => now(),

]

];

$chunks = array_chunk($notes, 50);
foreach ($chunks as $chunk) {
Note::insert($chunk);

}

$this->command->info('Seeded the Notes!');

}

}
