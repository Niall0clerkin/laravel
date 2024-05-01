<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note; // Assuming your model is named Note

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read the JSON file
        $json = file_get_contents(base_path('vacancies.json'));
        $data = json_decode($json, true);

        // Insert each vacancy into the database
        foreach ($data as $notes) {
            Note::create($notes);
        }
    }
}
