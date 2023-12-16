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
            'note' => "Cart 1",
            'cart_id' => 2,
            'productcolor_id' => 1,
        ]);

        CartItem::create([
            'quantity' => 3,
            'note' => "Cart 2",
            'cart_id' => 2,
            'productcolor_id' => 1,
        ]);

        CartItem::create([
            'quantity' => 2,
            'note' => "Cart 3",
            'cart_id' => 2,
            'productcolor_id' => 1,
        ]);
    }
}
