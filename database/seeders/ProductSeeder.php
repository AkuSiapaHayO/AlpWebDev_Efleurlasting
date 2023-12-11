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
            'category_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Size Lux',
            'description' => 'Premium artificial rose 9 stems',
            'size' => '55 x 50 cm',
            'price' => 230000,
            'category_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Size Petite',
            'description' => 'Artificial rose Single stem',
            'size' => '15 x 25 cm',
            'price' => 85000,
            'category_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Size Small',
            'description' => 'Mix Artificial Flower',
            'size' => '20-25 x 30 cm',
            'price' => 135000,
            'category_id' => 2,
        ]);
    }
}
