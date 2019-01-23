<?php

namespace Tests\Feature;

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
        $response = $this->get( '/threads/' . $this->thread->id );
        $response->assertSee( $this->thread->title );
    }

    /** @test */
    function a_user_can_view_single_thread()
    {
        $response = $this->get( '/threads/' . $this->thread->id );
        $response->assertSee( $this->thread->title );
    }
}
