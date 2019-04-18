<?php

namespace App;

class Spam
{

    public function detect( $body )
    {
        $this->detectInvalidKeywords( $body );

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

}