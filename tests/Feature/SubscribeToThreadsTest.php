<?php

namespace Tests\Unit;

use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
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

        // Then, each time a new reply is left...

        // A notification should be prepared for the user.
    }

}
