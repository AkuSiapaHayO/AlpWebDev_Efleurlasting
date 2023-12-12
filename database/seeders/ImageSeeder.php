<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            'image_name' => 'classic_sizeregular_1.jpg',
            'product_id' => '1'
        ]);

        Image::create([
            'image_name' => 'classic_sizeregular_2.jpg',
            'product_id' => '1'
        ]);

        Image::create([
            'image_name' => 'mixbouquet_sizepetite_1.jpg',
            'product_id' => '3'
        ]);

        Image::create([
            'image_name' => 'mixbouquet_sizepetite_2.jpg',
            'product_id' => '3'
        ]);

        Image::create([
            'image_name' => 'mixbouquet_sizepetite_3.jpg',
            'product_id' => '3'
        ]);
    }
}
