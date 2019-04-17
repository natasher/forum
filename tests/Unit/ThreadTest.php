<?php

namespace Tests\Unit;

use App\User;
use App\Thread;
use Tests\TestCase;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create( Thread::class );
    }

    /** @test */
    function a_thread_can_make_a_string_path()
    {
        $thread = create( 'App\Thread' );

        $this->assertEquals( "/threads/{$thread->channel->slug}/{$thread->id}", $thread->path() );
    }

    /** @test */
    function a_thread_has_replies()
    {
        $this->assertInstanceOf( 'Illuminate\Database\Eloquent\Collection', $this->thread->replies );
    }

    /** @test */
    function a_thread_has_a_creator()
    {
        $this->assertInstanceOf( User::class, $this->thread->creator );
    }

    /** @test */
    function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body'    => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount( 1, $this->thread->replies );
    }

    /** @test */
    function a_thread_notifies_all_registered_subscribers_when_a_reply_is_added()
    {
        Notification::fake();

        $this->signIn()
            ->thread
            ->subscribe()
            ->addReply([
                'body'    => 'Foobar',
                'user_id' => 999,
            ]);

        Notification::assertSentTo( auth()->user(), ThreadWasUpdated::class );
    }

    /** @test */
    function a_thread_can_be_subscribed_to()
    {
        // Given we have a thread
        $thread = create( Thread::class );

        // When the user subscribes to thread
        $thread->subscribe( $userId = 1);

        // Then we should be able to fetch all threads that the user has subscribed to.
        $this->assertEquals(
            1,
            $thread->subscriptions()->where( 'user_id', $userId )->count()
        );
    }

    /** @test */
    function a_thread_can_be_unsubscribed_from()
    {
        // Given we have a thread
        $thread = create( Thread::class );

        // And a user who is subscribed to the thread.
        $thread->subscribe( $userId = 1 );

        $thread->unsubscribe( $userId );

        $this->assertCount( 0, $thread->subscriptions );
    }

    /** @test */
    function it_knows_if_the_auth_user_is_subscribed_to_it()
    {
        // Given we have a thread
        $thread = create( Thread::class );

        // And a user who is subscribed to the thread.
        $this->signIn();

        $this->assertFalse( $thread->isSubscribedTo );

        $thread->subscribe();

        $this->assertTrue( $thread->isSubscribedTo );
    }

    /** @test */
    function a_thread_can_check_if_the_authenticated_user_has_read_all_replies()
    {
        $this->signIn();

        $thread = create( Thread::class );

        $this->assertTrue( $thread->hasUpdatesFor( auth()->user() ));
    }

}
