<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForum extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function an_unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post( '/threads/smth/1/replies', [] )
            ->assertRedirect( '/login' );
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = create( Thread::class );

        // When the user adds a reply to the thread
        $reply = make( Reply::class );
        $this->post( $thread->path() . '/replies', $reply->toArray() );

        // Then their reply should be visible on the page.
        $this->get( $thread->path() )
            ->assertSee( $reply->body );
    }
}
