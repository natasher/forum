<?php

namespace App;

use App\User;

class ThreadFilters
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * ThreadFilters constructor.
     */
    public function __construct( Request $request )
    {
        $this->request = $request;
    }

    public function apply( $builder )
    {
        // We appy our filters to the builder
        if (! $username = $this->request->by ) return $builder;

        $user = User::where( 'name', $username )->firstOrFail();

        return $builder->where( 'user_id', $user->id );
    }

}