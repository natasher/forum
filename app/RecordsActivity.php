<?php

namespace App;

trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {

        static::created(function ( $thread ) {
            $thread->recordActivity( 'created' );
        });

    }

    protected function recordActivity( $event )
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type'    => $this->getActivityType( $event ),
        ]);
    }

    protected function getActivityType( $event )
    {
        $type = strtolower((new \ReflectionClass( $this ))->getShortName());

        return "{$event}_{$type}";
    }

}