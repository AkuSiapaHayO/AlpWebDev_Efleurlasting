<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'total_amount',
        'payment_status',
        'delivery_date',
        'delivery_time',
        'recipient_name',
        'recipient_phone',
        'recipient_address',
        'notes',
        'transfer_evidence_img',
        'delivery_status',
        'isDelivery',
        'user_id'
    ];
}
