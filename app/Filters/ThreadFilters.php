<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [ 'by', 'popular', 'unanswered' ];

    /**
     * Filter the query by a given username.
     *
     * @param string $username
     * @return Builder
     */
    protected function by( $username )
    {
        $user = User::where( 'name', $username )->firstOrFail();

        return $this->builder->where( 'user_id', $user->id );
    }

    /**
     * Filter the query according to most popular threads
     *
     * @return Builder
     */
    protected function popular()
    {
        // Wipe out orders, Builder#oderBy its collide with Thread::latest().
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy( 'replies_count', 'desc' );
    }

    /**
     * Filter the query by threads without replies.
     *
     * @return Builder
     */
    protected function unanswered()
    {
        return $this->builder->where( 'replies_count', 0 );
    }

}