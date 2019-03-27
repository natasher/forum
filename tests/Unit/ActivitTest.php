<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\Activity;
use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create( Thread::class );

        $this->assertDatabaseHas( 'activities', [
            'type'         => 'created_thread',
            'user_id'      => auth()->id(),
            'subject_id'   => $thread->id,
            'subject_type' => Thread::class,
        ]);

        $activity = Activity::first();

        $this->assertEquals( $activity->subject->id, $thread->id );
    }

    /** @test */
    function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create( Reply::class );

        $this->assertEquals( 2, Activity::count() );
    }

    /** @test */
    function it_fetches_a_feed_for_any_user()
    {
        // Given we have a thread
        // And another thread from a week ago
        $this->signIn();

        create( Thread::class, [ 'user_id' => auth()->id() ], 2);

        auth()->user()
            ->activity()
            ->first()
            ->update([
                'created_at' => Carbon::now()->subWeek()
            ]);

        // When we fetch their feed.
        $feed = Activity::feed( auth()->user() );

        // Then, it should be returned in the proper format.
        $this->assertTrue(
            $feed->keys()
                ->contains(
                    Carbon::now()->format( 'Y-m-d' )
                )
        );

        $this->assertTrue( $feed->keys()->contains(
            Carbon::now()->subWeek()->format( 'Y-m-d' )
        ));

    }

}