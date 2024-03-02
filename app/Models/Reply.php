<?php

namespace App\Models;

use App\Models\Thread;
use App\Models\Favorite;
use App\Models\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;
    use Favoritable;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            Activity::create([
                'user_id' => auth()->id(),
                'subject_id' => $reply->id,
                'subject_type' => self::class,
                'type' => 'created_reply'
            ]);
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
