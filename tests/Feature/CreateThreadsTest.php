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
        $this->expectException( 'Illuminate\Auth\AuthenticationException' );

        $thread = make( Thread::class );

        $this->post( '/threads', $thread->toArray() );
    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_thread()
    {
        $this->actingAs( factory( User::class )->create() );

        $thread = make( Thread::class );

        $this->post( '/threads', $thread->toArray() );

        $this->get( '/threads/1' )
            ->assertSee( $thread->title )
            ->assertSee( $thread->body );
    }

}
