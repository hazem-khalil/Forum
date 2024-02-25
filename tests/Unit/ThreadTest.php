<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function a_thread_has_replies(): void
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_a_creator(): void
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'FooBar',
            'user_id' => 1,
            'thread_id' => $this->thread->id
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
