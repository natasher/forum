<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get( '/threads/create' )
            ->assertRedirect( '/login' );

        $this->post( '/threads' )
            ->assertRedirect( '/login' );
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_thread()
    {
        $this->signIn();

        $thread = make( Thread::class );

        $response = $this->post( '/threads', $thread->toArray() );

        $this->get( $response->headers->get( 'Location' ) )
            ->assertSee( $thread->title )
            ->assertSee( $thread->body );
    }

    /** @test */
    function a_thread_belongs_to_a_channel()
    {
        $thread = create( 'App\Thread' );

        $this->assertInstanceOf( 'App\Channel', $thread->channel );
    }

    /** @test */
    function a_thread_requires_a_title()
    {
        $this->publishThread([ 'title' => null ])
            ->assertSessionHasErrors( 'title' );
    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread([ 'body' => null ])
            ->assertSessionHasErrors( 'body' );
    }

    /** @test */
    function a_thread_requires_a_valid_channel()
    {
        factory( 'App\Channel', 2 )->create();

        $this->publishThread([ 'channel_id' => null ])
            ->assertSessionHasErrors( 'channel_id' );

        $this->publishThread([ 'channel_id' => 999 ])
            ->assertSessionHasErrors( 'channel_id' );
    }

    /** @test */
    function a_thread_can_be_deleted()
    {
        $this->signIn();

        $thread = create( Thread::class );

        $this->json( 'DELETE', $thread->path() );

        $this->assertDatabaseMissing( 'threads', [ 'id' => $thread->id ] );
    }

    public function publishThread( $overrides = [] )
    {
        $this->withExceptionHandling()
            ->signIn();

        $thread = make( 'App\Thread', $overrides );

        return $this->post( '/threads', $thread->toArray() );
    }

}
