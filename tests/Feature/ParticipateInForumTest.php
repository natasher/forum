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
        $this->assertDatabaseHas( 'replies', [ 'body' => $reply->body ]);
        // Should increment replies_count on Thread
        $this->assertEquals( 1, $thread->fresh()->replies_count );
    }

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()
            ->signIn();

        $thread = create( 'App\Thread' );
        $reply  = make( 'App\Reply', [ 'body' => null ]);

        $this->post( $thread->path() . '/replies', $reply->toArray() )
            ->assertStatus( 422 );
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

        $this->delete( "/replies/{$reply->id}" )
            ->assertStatus( 302 );

        $this->assertDatabaseMissing( 'replies', [ 'id' => $reply->id ]);
        $this->assertEquals( 0, $reply->thread->fresh()->replies_count );
    }

    /** @test */
    function authorized_users_can_update_replies()
    {
        $this->signIn();
        $reply = create( Reply::class, [ 'user_id' => auth()->id() ]);

        $updatedReply = 'You been changed, fool';
        $this->patch( "/replies/{$reply->id}", [ 'body' => $updatedReply ] );

        $this->assertDatabaseHas( 'replies', [ 'id' => $reply->id, 'body' => $updatedReply ]);
    }

    /** @test */
    function unauthorized_users_cannot_update_replies()
    {
        $this->withExceptionHandling();

        $reply = create( Reply::class );

        $this->patch( "/replies/{$reply->id}" )
            ->assertRedirect( "login" );

        $this->signIn()
            ->patch( "/replies/{$reply->id}" )
            ->assertStatus( 403 );
    }

    /** @test */
    function replies_that_contain_spam_may_not_be_created()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create( Thread::class );
        $reply  = make( Reply::class, [
            'body' => 'Yahoo Customer Support',
        ]);

        $this->post( $thread->path() . '/replies', $reply->toArray() )
            ->assertStatus( 422 );
    }

}
