<?php

namespace App;

use App\User;
use App\Favorite;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    protected $with = [ 'owner', 'favorites' ];

    public function owner()
    {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function favorites()
    {
        return $this->morphMany( Favorite::class, 'favorited' );
    }

    public function favorite( $userId )
    {
        $attributes = [ 'user_id' => $userId ];

        if (! $this->favorites()->where( $attributes )->exists() ) {
            $this->favorites()->create( $attributes );
        }
    }

    public function isFavorited()
    {
        return $this->favorites()->where( 'user_id', auth()->id() )->exists();
    }

}
