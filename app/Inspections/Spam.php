<?php

namespace App\Inspections;

class Spam
{

    public function detect( $body )
    {
        $this->detectInvalidKeywords( $body );
        $this->detectKeyHeldDown( $body );

        return false;
    }

    protected function detectInvalidKeywords( $body )
    {
        $invalidKeyword = [
            'yahoo customer support',
        ];

        foreach( $invalidKeyword as $keyword ) {
            if ( stripos( $body, $keyword ) !== false ) {
                throw new \Exception( 'Your reply contains spam' );
            }
        }
    }

    protected function detectKeyHeldDown( $body )
    {
        if ( preg_match( '/(.)\\1{4,}/', $body ) ) {
            throw new \Exception( 'Your reply contains multiple repetition of same character' );
        }
    }

}