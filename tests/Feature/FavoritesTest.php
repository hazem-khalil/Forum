<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_guest_can_not_favorite_any_thing()
    {
        $this->post('/replies/1/favorites')
            ->assertRedirect('/login');

    }
    
    /** @test */
    public function an_authenticated_user_can_favorite_a_reply(): void
    {
        $this->be($user = User::factory()->create());

        $reply = Reply::factory()->create();

        $this->post('/replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once(): void
    {
        $this->be($user = User::factory()->create());

        $reply = Reply::factory()->create();

        try {
            $this->post('/replies/' . $reply->id . '/favorites');
            $this->post('/replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
