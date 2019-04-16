<?php

namespace Tests\Unit;

use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToThreadsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        // Given we have auth user.
        $this->signIn();

        // And we have a thread...
        $thread = create( Thread::class );

        // And the user subscribes to the thread...
        $this->post( $thread->path() . '/subscriptions' );

        $this->assertCount( 0, auth()->user()->notificatinos );

        // Then, each time a new reply is left...
        $thread->addReply([
            'user_id' => auth()->id(),
            'body'    => 'Some reply here',
        ]);

        // A notification should be prepared for the user.
        $this->assertCount( 1, auth()->user()->notifications );
    }

    /** @test */
    public function a_user_can_unsubscribe_from_threads()
    {
        $this->signIn();

        $thread = create( Thread::class );

        $this->delete( $thread->path() . '/subscriptions' );

        $this->assertCount( 0, $thread->subscriptions );
    }

}
