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

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()
            ->signIn();

        $thread = create( 'App\Thread' );
        $reply  = make( 'App\Reply', [ 'body' => null ]);

        $this->post( $thread->path() . '/replies', $reply->toArray() )
            ->assertSessionHasErrors( 'body' );
    }

    /** @test */
    function unauthorized_users_cannot_delete_replies()
    {
        $this->withExceptionHandling();

        $reply = create( Reply::class );

        $this->delete( "/replies/{$reply->id}" )
            ->assertRedirect( 'login' );

        $this->signIn()
            ->delete( "/replies/{$reply->id}" )
            ->assertStatus( 403 );
    }

    /** @test */
    function authorized_users_can_delete_replies()
    {
        $this->signIn();
        $reply = create( Reply::class, [ 'user_id' => auth()->id() ]);

        $this->delete( "/replies/{$reply->id}" );

        $this->assertDatabaseMissing( 'replies', [ 'id' => $reply->id ]);
    }

}
