<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $users2comment = User::inRandomOrder()->limit(mt_rand(0, 10))->get();
            foreach ($users2comment as $user2comment) {
                Like::factory()->create([
                    'user_id' => $user2comment->id,
                    'post_id' => $post->id
                ]);
            }
        }
    }
}
