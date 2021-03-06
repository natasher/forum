<?php

namespace App;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email',
    ];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function threads()
    {
        return $this->hasMany( Thread::class )->latest();
    }

    public function lastReply()
    {
        return $this->hasOne( Reply::class )->latest();
    }

    public function activity()
    {
        return $this->hasMany( Activity::class );
    }

    public function read( $thread )
    {
        cache()->forever(
            $this->visitedThreadCacheKey( $thread ),
            Carbon::now()
        );
    }

    public function visitedThreadCacheKey( $thread )
    {
        return sprintf( "users.%s.visits.%s", $this->id, $thread->id );
    }

}
