<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([

            UserSeeder::class,
            commentSeeder::class,
            VacancySeeder::class,
        
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
