<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'order_date' => now(),
            'total_amount' => 50000,
            'payment_status' => false,
            'delivery_date' => now()->addDays(3),
            'delivery_time' => '14:00:00',
            'recipient_name' => 'John Doe',
            'recipient_phone' => '1234567890',
            'recipient_address' => '123 Main St, City',
            'notes' => 'Sample notes',
            'payment_details' => 'ok',
            'transfer_evidence_img' => 'sample_image.jpg',
            'delivery_status' => false,
            'isDelivery' => true,
            'user_id' => 2,
        ]);

        Order::create([
            'order_date' => now(),
            'total_amount' => 50000,
            'payment_status' => true,
            'delivery_date' => now()->addDays(3),
            'delivery_time' => '7:00:00',
            'recipient_name' => 'John Doe',
            'recipient_phone' => '1234567890',
            'recipient_address' => '123 Main St, City',
            'notes' => 'Sample notes',
            'payment_details' => 'ok',
            'transfer_evidence_img' => 'sample_image.jpg',
            'delivery_status' => false,
            'isDelivery' => true,
            'user_id' => 2,
        ]);
    }
}
