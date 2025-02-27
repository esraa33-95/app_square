<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name', 'zone_id']; 

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id'); 
    }

public function location()
    {
        return $this->hasMany(Location::class);
    }

    
}
