<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CartItem::create([
            'quantity' => 1,
            'cart_id' => 1,
            'product_id' => 1,
        ]);

        CartItem::create([
            'quantity' => 3,
            'cart_id' => 1,
            'product_id' => 2,
        ]);

        CartItem::create([
            'quantity' => 2,
            'cart_id' => 2,
            'product_id' => 3,
        ]);
    }
}
