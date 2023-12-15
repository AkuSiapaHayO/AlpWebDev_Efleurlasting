<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'size',
        'price',
        'is_active',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function productColors(): HasMany {
        return $this->hasMany(ProductColor::class);
    }

    public function images(): HasMany {
        return $this->hasMany(Image::class);
    }

}
