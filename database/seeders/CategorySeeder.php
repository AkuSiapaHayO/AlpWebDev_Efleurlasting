<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Doesn't have the correct description.
        Category::create([
            'category_name' => 'Classic Bouquet',
            'description' => 'artificial rose bouquet'
        ]);

        Category::create([
            'category_name' => 'Mix Bouquet',
            'description' => 'artificial mix bouquet'
        ]);

        Category::create([
            'category_name' => 'Graduation Bouquet',
            'description' => 'artificial flower bouquet'
        ]);

        Category::create([
            'category_name' => 'Bloom Box',
            'description' => 'artificial flower bouquet in a box'
        ]);

        Category::create([
            'category_name' => 'Balloon Series',
            'description' => 'artificial flower with balloon'
        ]);

        Category::create([
            'category_name' => 'Gift Series',
            'description' => 'artificial flower gift set'
        ]);

        Category::create([
            'category_name' => 'Premium Collection',
            'description' => 'artificial flower premium'
        ]);
    }
}
