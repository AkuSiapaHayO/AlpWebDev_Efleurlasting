<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductColor::create([
            'product_id' => 3,
            'color_id' => 1,
        ]);

        ProductColor::create([
            'product_id' => 3,
            'color_id' => 2,
        ]);

        ProductColor::create([
            'product_id' => 1,
            'color_id' => 2,
        ]);
    }
}
