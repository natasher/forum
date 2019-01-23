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
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be( $user = factory( User::class )->create() );

        $thread = factory( Thread::class )->create();

        // When the user adds a reply to the thread
        $reply = factory( Reply::class )->make();
        $this->post( '/threads/' . $thread->id . '/replies', $reply->toArray() );

        // Then their reply should be visible on the page.
        $this->get( $thread->path() )
            ->assertSee( $reply->body );
    }
}
