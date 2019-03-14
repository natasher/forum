<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function guest_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post( 'replies/1/favorites' )
            ->assertRedirect( '/login' );
    }

    /** @test */
    // public function an_authenticated_user_can_favorite_any_reply()
    // {
    //     // /replies/id/favorites
    //     $reply = create( 'App\Reply' );

    //     // If I post to a "favorite" endpoint
    //     $this->post( 'replies/' . $reply->id . '/favorites' );

    //     // It should be recorded in the database.
    //     $this->assertCount( 1, $reply->favorites );
    // }

}