<?php

namespace Tests\Unit;

use App\User;
use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_has_an_owner()
    {
        $reply = factory( Reply::class )->create();

        $this->assertInstanceOf( User::class, $reply->owner );
    }

}
