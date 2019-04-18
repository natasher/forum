<?php

namespace Tests\Unit;

use App\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_spam()
    {
        $spam = new Spam();

        $this->assertFalse(
            $spam->detect( 'Innocent reply here' )
        );

        $this->expectException( 'Exception' );

        $spam->detect( 'yahoo customer support' );
    }

}
