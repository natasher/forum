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

}
