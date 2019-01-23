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

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory( Thread::class )->create();
    }

    /** @test */
    function a_thread_has_replies()
    {
        $this->assertInstanceOf( 'Illuminate\Database\Eloquent\Collection', $this->thread->replies );
    }

    /** @test */
    function a_thread_has_a_creator()
    {
        $this->assertInstanceOf( User::class, $this->thread->creator );
    }

    /** @test */
    function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body'    => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount( 1, $this->thread->replies );
    }

}
