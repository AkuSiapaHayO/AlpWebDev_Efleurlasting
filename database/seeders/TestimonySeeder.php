<?php

namespace Database\Seeders;

use App\Models\Testimony;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimony::create([
            'testimony' => "Cool",
            'testimony_image' => "classic_sizeregular_1.jpg",
            'name' => "Karyna",
            'date' => now(),
            'user_id' => "2",
            'productcolor_id' => 33,
        ]);

        Testimony::create([
            'testimony' => "Cool",
            'testimony_image' => "classic_sizeregular_1.jpg",
            'name' => "Karyna",
            'date' => now(),
            'user_id' => "2",
            'productcolor_id' => 33,
        ]);
    }
}
