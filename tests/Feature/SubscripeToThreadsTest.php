<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscripeToThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_subscripe_to_threads(): void
    {
        $this->actingAs($user = User::factory()->create());

        $thread = Thread::factory()->create();

        $this->post($thread->path() . "/subscriptions");

        $this->assertCount(1, $thread->subscriptions);
    }
}
