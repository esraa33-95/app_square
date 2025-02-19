<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name',
];

public function zone()
    {
        return $this->hasMany(Zone::class);
    }

public function location()
    {
        return $this->hasMany(Location::class);
    }
}
