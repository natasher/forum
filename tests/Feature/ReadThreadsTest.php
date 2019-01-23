<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory( Thread::class )->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get( '/threads/' . $this->thread->id )
            ->assertSee( $this->thread->title );
    }

    /** @test */
    function a_user_can_view_single_thread()
    {
        $this->get( '/threads/' . $this->thread->id )
            ->assertSee( $this->thread->title );
    }

    /** @test */
    function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory( Reply::class )
            ->create([ 'thread_id' => $this->thread->id ]);

        $this->get( '/threads/' . $this->thread->id )
            ->assertSee( $reply->body );
    }

}
