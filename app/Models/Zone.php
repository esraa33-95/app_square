<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['name']; 

    public function areas()
    {
        return $this->hasMany(Area::class, 'zone_id'); 
    }

    public function location()
    {
        return $this->hasMany(Location::class);
    }

   
}
