<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::truncate();
        // Reply::truncate();
        // Thread::truncate();
        // Channel::truncate();

        
        $threads = Thread::factory(50)->create();
        
        foreach ($threads as $thread) {
            Reply::factory(10)->create([
                'user_id' => $thread->user_id,
                'thread_id' => $thread->id,
                'body' => fake()->paragraph
            ]);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
