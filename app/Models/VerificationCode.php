<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class VerificationCode extends Model
{
    protected $fillable = [
        'code',
        'expired_at',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
    



    
}
