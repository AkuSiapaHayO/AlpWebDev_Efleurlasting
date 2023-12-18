<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::create([
            'color_name' => 'Pink',
        ]);

        Color::create([
            'color_name' => 'Lilac',
        ]);

        Color::create([
            'color_name' => 'Red',
        ]);

        Color::create([
            'color_name' => 'Blue',
        ]);

        Color::create([
            'color_name' => 'White',
        ]);

        Color::create([
            'color_name' => '*Customizable colors pallete (flower & wrapping paper)',
        ]);

        Color::create([
            'color_name' => 'Purple',
        ]);
    }
}
