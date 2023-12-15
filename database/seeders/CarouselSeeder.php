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
            'image' => 'Carousel1.JPG',
            'description' => 'Gift your loved ones flowers that will last a lifetime. With many different variations of artificial flowers that you can customize. Holiday sale up to 50%'
        ]);

        Carousel::create([
            'title' => 'Blossom Elegance',
            'image' => 'Carousel2.JPG',
            'description' => 'Explore our exquisite collection of customizable artificial flower bouquets. Elevate your space with timeless beauty and lasting elegance.'
        ]);

        Carousel::create([
            'title' => 'Seasonal Delights',
            'image' => 'Carousel3.JPG',
            'description' => 'Discover seasonal specials and promotions! From vibrant spring blooms to cozy winter arrangements, find the perfect artificial bouquet for every occasion.'
        ]);

        Carousel::create([
            'title' => 'Express Your Style',
            'image' => 'Carousel4.JPG',
            'description' => 'Design your own floral masterpiece! Unleash your creativity with our custom artificial flower bouquets. Your unique style, our endless possibilities.'
        ]);
    }
}
