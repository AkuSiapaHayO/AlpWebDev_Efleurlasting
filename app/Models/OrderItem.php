<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'note',
        'order_id',
        'productcolor_id'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function productcolor() {
        return $this->belongsTo(ProductColor::class);
    }
}
