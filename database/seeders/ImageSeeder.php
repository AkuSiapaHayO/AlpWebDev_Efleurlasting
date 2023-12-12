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
            'image_name' => 'classic_sizeregular_1',
            'product_id' => '1'
        ]);

        Image::create([
            'image_name' => 'classic_sizeregular_2',
            'product_id' => '1'
        ]);
    }
}
