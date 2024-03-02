<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_must_not_add_replies()
    {
        $this->post('threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads(): void
    {
        $this->be($user = User::factory()->create());

        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make();

        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->be($user = User::factory()->create());

        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make(['body' => null]);

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $reply = Reply::factory()->create();

        $this->delete("/replies/{$reply->id}")
            ->assertRedirect('/login');

        $this->actingAs($user = User::factory()->create())
            ->delete("/replies/{$reply->id}")
            ->assertStatus(403);

    }

    /** @test */
    public function an_autherized_users_can_delete_replies()
    {
        $this->actingAs($user = User::factory()->create());

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}
