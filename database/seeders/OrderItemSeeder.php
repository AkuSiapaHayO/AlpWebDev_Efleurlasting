<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderItem::create([
            'quantity' => 2,
            'note' => 'First Order Item',
            'order_id' => 1,
            'productcolor_id' => 1,
        ]);

        OrderItem::create([
            'quantity' => 1,
            'note' => 'Second Order Item',
            'order_id' => 1,
            'productcolor_id' => 3,
        ]);

        OrderItem::create([
            'quantity' => 1,
            'note' => 'Third Order Item',
            'order_id' => 2,
            'productcolor_id' => 6,
        ]);
    }
}
