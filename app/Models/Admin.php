<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function Profile()
    {
        return $this->morphOne(Profile::class,'profileable');
    }
}
