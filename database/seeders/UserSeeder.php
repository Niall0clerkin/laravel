<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder

{

/**

* Seed the application's database.

*

* @return void

*/

public function run()

{

User::create([

'name' => "Peter Nicholl",

'email' => 'pete@abc.com',

'password' => Hash::make('qwerty1234'),

'email_verified_at' => now(),

]);

User::factory()->count(2)->create();

}

}
