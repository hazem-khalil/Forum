<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function a_user_can_view_all_threads(): void
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread(): void
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);        
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = Reply::factory()->create([
            'thread_id' => $this->thread->id,
            'user_id' => $this->thread->user_id
        ]);

        $response = $this->get($this->thread->path());

        $response->assertSee($reply->body);
    }
}
