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
            'testimony' => "I am thrilled with the lifelike quality of the artificial flowers from Efleurlasting. They add effortless beauty to my home without the need for maintenance, and I highly recommend their products.",
            'testimony_image' => "classic_sizeregular_1.jpg",
            'name' => "Karyna",
            'date' => now(),
            'user_id' => "2",
            'productcolor_id' => 33,
        ]);

        Testimony::create([
            'testimony' => "Exceptional quality and hassle-free beauty – the artificial flowers from Efleurlasting exceeded my expectations. A perfect addition to any home!",
            'testimony_image' => "classic_sizeregular_1.jpg",
            'name' => "Karyna",
            'date' => now(),
            'user_id' => "2",
            'productcolor_id' => 33,
        ]);
    }
}
