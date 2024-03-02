<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function guests_cannot_see_the_create_thread_page()
    {
        $this->get('threads/create')
            ->assertRedirect('/login');

    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads(): void
    {
        $this->actingAs(User::factory()->create());

        $thread = Thread::factory()->create();

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        Channel::factory()->create(['id' => 2]);

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors('channel_id');    
    }

    /** @test */
    public function an_authorized_user_cannot_delete_threads()
    {
        $thread = Thread::factory()->create();

        $response = $this->delete($thread->path())
            ->assertRedirect('/login'); 

        $this->actingAs($user = User::factory()->create());

        $this->delete($thread->path())
            ->assertStatus(403);
    }

    /** @test */
    public function an_authorized_user_delete_threads()
    {
        $this->actingAs($user = User::factory()->create());

        $thread = Thread::factory()->create(['user_id' => auth()->id()]);

        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    protected function publishThread($overrides = [])
    {
        $this->actingAs(User::factory()->create());

        $thread = Thread::factory()->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
