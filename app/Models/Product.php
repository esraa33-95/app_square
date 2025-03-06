<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products', 'cart_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_products')->withPivot('quantity');
    }
}
