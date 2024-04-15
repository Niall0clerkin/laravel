<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([

            'name' => 'niall clerkin',

            'email' => 'niall0clerkin@gmail.com',

            ]);

            Note::factory(10)->create();
    }
}
