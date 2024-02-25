<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    protected $reply;

    public function setUp(): void
    {
        parent::setUp();

        $this->reply = Reply::factory()->create();
    }

    /** @test */
    public function it_has_an_owner(): void
    {
        $this->assertInstanceOf(User::class, $this->reply->owner);
    }

    /** @test */
    public function a_reply_belongs_to_thread(): void
    {
        $this->assertInstanceOf(Thread::class, $this->reply->thread); 
    }
}
