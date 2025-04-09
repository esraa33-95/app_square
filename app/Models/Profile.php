<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'image',
        
    ];

    public function Profileable()
    {
        return $this->morphTo();
    }
}
