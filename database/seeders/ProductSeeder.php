<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Size Reguler',
            'description' => 'Premium artificial rose 5 stems',
            'size' => '40 x 50 cm',
            'price' => 150000,
            'is_active' => true,
            'category_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Size Lux',
            'description' => 'Premium artificial rose 9 stems',
            'size' => '55 x 50 cm',
            'price' => 230000,
            'is_active' => true,
            'category_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Size Petite',
            'description' => 'Artificial rose Single stem, include greeting cards & goodie bag',
            'size' => '15 x 25 cm',
            'price' => 85000,
            'is_active' => true,
            'category_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Size Small',
            'description' => 'Mix Artificial Flower',
            'size' => '20-25 x 30 cm',
            'price' => 135000,
            'is_active' => true,
            'category_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Size Medium',
            'description' => 'Mix Artificial Flower',
            'size' => '30 x 40 cm',
            'price' => 185000,
            'is_active' => true,
            'category_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Size Large',
            'description' => 'Mix Artificial Flower',
            'size' => '40-45 x 45 cm',
            'price' => 275000,
            'is_active' => true,
            'category_id' => 2,
        ]);

        Product::create([
            'product_name' => 'mini Pom',
            'description' => 'Pom Character Graduation ver.',
            'size' => '20-25 x 30 cm',
            'price' => 135000,
            'is_active' => true,
            'category_id' => 3,
        ]);

        Product::create([
            'product_name' => 'midi Pom',
            'description' => 'Pom Character Graduation ver.',
            'size' => '30 x 40 cm',
            'price' => 185000,
            'is_active' => true,
            'category_id' => 3,
        ]);

        Product::create([
            'product_name' => 'midi Teddy',
            'description' => 'Graduation Teddy bear size 12cm',
            'size' => '35-40 x 40 cm',
            'price' => 200000,
            'is_active' => true,
            'category_id' => 3,
        ]);

        Product::create([
            'product_name' => 'Large Teddy',
            'description' => 'Graduation Teddy bear size 15cm',
            'size' => '50-55 x 50 cm',
            'price' => 255000,
            'is_active' => true,
            'category_id' => 3,
        ]);

        Product::create([
            'product_name' => 'Mini',
            'description' => 'Box color is only available in white',
            'size' => 'd.8cm t.10cm',
            'price' => 150000,
            'is_active' => true,
            'category_id' => 4,
        ]);

        Product::create([
            'product_name' => 'Midi',
            'description' => 'Box color is only available in white',
            'size' => 'd.12cm t.12cm',
            'price' => 225000,
            'is_active' => true,
            'category_id' => 4,
        ]);
    }
}
