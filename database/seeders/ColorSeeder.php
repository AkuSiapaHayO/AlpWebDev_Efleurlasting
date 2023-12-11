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
            'color_name' => 'pink',
        ]);

        Color::create([
            'color_name' => 'lilac',
        ]);

        Color::create([
            'color_name' => 'red',
        ]);

        Color::create([
            'color_name' => 'blue',
        ]);

        Color::create([
            'color_name' => 'white',
        ]);
    }
}
