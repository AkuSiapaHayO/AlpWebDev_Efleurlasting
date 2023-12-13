<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carousel::create([
            'title' => 'Efleurlasting',
            'image' => 'classic_sizeregular_2.jpg',
            'description' => 'Gift your loved ones flowers that will last a lifetime. With many different variations of artificial flowers that you can customize. Holiday sale up to 50%'
        ]);

        Carousel::create([
            'title' => 'Efleurlasting',
            'image' => 'classic_sizeregular_2.jpg',
            'description' => 'Gift your loved ones flowers that will last a lifetime. With many different variations of artificial flowers that you can customize. Holiday sale up to 50%'
        ]);

        Carousel::create([
            'title' => 'Efleurlasting',
            'image' => 'classic_sizeregular_2.jpg',
            'description' => 'Gift your loved ones flowers that will last a lifetime. With many different variations of artificial flowers that you can customize. Holiday sale up to 50%'
        ]);

        Carousel::create([
            'title' => 'Efleurlasting',
            'image' => 'classic_sizeregular_2.jpg',
            'description' => 'Gift your loved ones flowers that will last a lifetime. With many different variations of artificial flowers that you can customize. Holiday sale up to 50%'
        ]);
    }
}
