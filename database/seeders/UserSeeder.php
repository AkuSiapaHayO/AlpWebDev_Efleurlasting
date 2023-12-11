<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => "Lmwao",
            'email' => "louis@example.com",
            'password' => bcrypt('12345678'),
            'name' => "Louis",
            'gender' => 'Male', 
            'age' => 19, 
            'birthdate' => '2004-04-14', 
            'phone' => '082171833200', 
            'address' => "VBR 3 PE 13-48, Pakuwon Indah",
            'province' => 'Jawa Timur',
            'city' => 'Surabaya',
            'district' => 'Sambikerep',
            'zipcode' => 60216,
            'role_id' => 1, 
            'is_login' => '0', 
        ]);
    }
}
