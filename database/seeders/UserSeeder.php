<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $json = file_get_contents(base_path('users.json'));
        $data = json_decode($json, true);

        
        foreach ($data as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'is_superuser' => $user['is_superuser'] ?? false,
                'email_verified_at' => $user['email_verified_at'] ?? now(),
            ]);
        }

        
    }
}
