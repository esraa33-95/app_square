<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name', 
        'area_id'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function location()
    {
        return $this->hasMany(Location::class);
    }
}
