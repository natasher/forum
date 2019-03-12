<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters
{

    protected $request;
    protected $builder;

    /**
     * ThreadFilters constructor.
     */
    public function __construct( Request $request )
    {
        $this->request = $request;
    }

    public function apply( $builder )
    {
        $this->builder = $builder;

        // We appy our filters to the builder
        if (! $username = $this->request->by ) return $builder;

        return $this->by( $username );
    }

    protected function by( $username )
    {
        $user = User::where( 'name', $username )->firstOrFail();

        return $this->builder->where( 'user_id', $user->id );
    }

}