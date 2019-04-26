<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_has_an_owner()
    {
        $reply = create( Reply::class );

        $this->assertInstanceOf( User::class, $reply->owner );
    }

    /** @test */
    function it_knows_if_it_was_just_published()
    {
        $reply = create( Reply::class );

        $this->assertTrue( $reply->wasJustPublished() );

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse( $reply->wasJustPublished() );
    }

}
