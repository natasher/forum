<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply()
    {
        $this->signIn();

        $thread = create( Thread::class )->subscribe();

        $this->assertCount( 0, auth()->user()->notifications );

        // Then, each time a new reply is left...
        $thread->addReply([
            'user_id' => auth()->id(),
            'body'    => 'Some reply here',
        ]);

        // A notification should be prepared for the user.
        $this->assertCount( 1, auth()->user()->fresh()->notifications );
    }

}
