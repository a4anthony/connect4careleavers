<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\LikeComment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = Comment::all();
        foreach ($comment as $post) {
            $users2comment = User::inRandomOrder()->limit(mt_rand(0, 10))->get();
            foreach ($users2comment as $user2comment) {
                LikeComment::factory()->create([
                    'user_id' => $user2comment->id,
                    'comment_id' => $post->id
                ]);
            }
        }
    }
}
