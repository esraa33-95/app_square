<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
         
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }


}
