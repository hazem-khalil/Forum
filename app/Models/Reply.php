<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
