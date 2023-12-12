<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'cart_id',
        'productcolor_id'
    ];

    public function productColor() {
        return $this->belongsTo(ProductColor::class);
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
