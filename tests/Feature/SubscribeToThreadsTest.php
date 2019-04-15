<?php

namespace Tests\Unit;

use App\User;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        $thread = create( Thread::class );

        $this->post( $thread->path() . '/subscriptions' );

        $this->assertCount( 1, $thread->subscriptions );
    }

}
