<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //disable foreign key check for this connection before running seeders

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([

            UserSeeder::class,

            NoteSeeder::class,

        ]);

        // supposed to only apply to a single connection and reset it's self

        // but I like to explicitly undo what I've done for clarity

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
