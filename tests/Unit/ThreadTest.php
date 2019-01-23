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
    function a_thread_has_replies()
    {
        $thread = factory( Thread::class )->create();

        $this->assertInstanceOf( 'Illuminate\Database\Eloquent\Collection', $thread->replies );
    }

    /** @test */
    function a_thread_has_a_creator()
    {
        $thread = factory( Thread::class )->create();

        $this->assertInstanceOf( User::class, $thread->creator );
    }

}
