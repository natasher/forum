<?php

namespace App;

use App\User;
use App\Thread;
use App\Favorite;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected $with = [ 'owner', 'favorites' ];

    protected $appends = [ 'favoritesCount' ];

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function thread()
    {
        return $this->belongsTo( Thread::class );
    }

}
