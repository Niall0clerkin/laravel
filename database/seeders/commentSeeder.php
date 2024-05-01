<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read the JSON file containing comments data
        $json = file_get_contents(base_path('comments.json'));
        $comments = json_decode($json, true);

        // Insert comments into the database
        foreach ($comments as $comment) {
            Comment::create($comment);
        }

        
    }
}
