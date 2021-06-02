<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        User::insert([
            'name' => 'Hakan DİNÇTÜRK',
            'email' => 'test@example.com',
            'password' => bcrypt('deneme12345'), // password
            'role' => 'owner',
        ]);
    }
}
