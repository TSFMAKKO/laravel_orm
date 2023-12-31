<?php

namespace Database\Seeders;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Post::factory(5)->create()->each(function ($post) {
            Comment::factory(5)->create(['post_id' => $post->id])->each(function ($comment) {
                Reply::factory(5)->create(['comment_id' => $comment->id]);
            });
        });
    }
}
