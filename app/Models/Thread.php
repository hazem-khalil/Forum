<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    protected $with = ['channel', 'creator'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function ($thread) {
            // $thread->replies->each->delete();
            $thread->replies->each(function ($reply) {
                $reply->delete();
            });
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply(array $reply)
    {
        Reply::create($reply); 
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscripe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
    }

    public function unsubscripe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();

    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }
}
