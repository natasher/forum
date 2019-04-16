<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_the_current_user()
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
        $this->assertCount( 0, auth()->user()->fresh()->notifications );

        $thread->addReply([
            'user_id' => create( User::class )->id,
            'body'    => 'Someonelse reply here',
        ]);

        $this->assertCount( 1, auth()->user()->fresh()->notifications );
    }

    /** @test */
    public function a_user_can_clear_a_notification()
    {
        $this->signIn();

        $thread = create( Thread::class )->subscribe();

        $thread->addReply([
            'user_id' => create( User::class )->id,
            'body'    => 'Some reply here'
        ]);

        $this->assertCount( 1, auth()->user()->unreadNotifications );

        $notificationId = auth()->user()->unreadNotifications->first()->id;

        $this->delete( "/profiles/{auth()->user()->name}/notifications/{$notificationId}" );

        $this->assertCount( 0, auth()->user()->fresh()->unreadNotifications );
    }

}
