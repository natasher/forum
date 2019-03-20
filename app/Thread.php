<?php

namespace App;

use App\Reply;
use App\Channel;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    protected $with = [ 'creator', 'channel' ];

    protected static function boot()
    {
        /**
         * Global query scope.
         */
        parent::boot();

        static::addGlobalScope( 'replyCount', function ( $builder ) {
            $builder->withCount( 'replies' );
        });

        static::deleting(function ( $thread ) {
            $thread->replies()->delete();
        });

        static::created(function ( $thread ) {
            Activity::create([
                'user_id'      => auth()->id(),
                'type'         => 'created_' . strtolower((new \ReflectionClass( $thread ))->getShortName()),
                'subject_id'   => $thread->id,
                'subject_type' => get_class( $thread ),
            ]);
        });

    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany( Reply::class );
    }

    public function creator()
    {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function channel()
    {
        return $this->belongsTo( Channel::class );
    }

    public function addReply( $reply )
    {
        $this->replies()->create ( $reply );
    }

    public function scopeFilter( $query, $filters )
    {
        return $filters->apply( $query );
    }

}
