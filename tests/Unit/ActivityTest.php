<?php

namespace Tests\Unit;

use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Activity;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created(): void
    {
        $this->actingAs($user = User::factory()->create());

        $thread = Thread::factory()->create();

        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => Thread::class,
            'type' => 'created_thread'
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created(): void
    {
        $this->actingAs($user = User::factory()->create());

        Reply::factory()->create();
        
        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_user()
    {
        $this->actingAs($user = User::factory()->create());

        Thread::factory(2)->create();

        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek() ]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
