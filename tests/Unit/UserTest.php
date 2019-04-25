<?php

namespace Test\Feature;

use App\User;
use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_fetch_their_most_recent_reply()
    {
        $user = create( User::class );

        $reply = create( Reply::class, [ 'user_id' => $user->id ]);

        $this->assertEquals( $reply->id, $user->lastReply->id );
    }

}