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
        $this->signIn();

        $thread = make( 'App\Thread', [ 'title' => null ]);

        $this->post( '/threads', $thread->toArray() )
            ->assertSessionHasErrors( 'title' );
    }

}
