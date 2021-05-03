<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(FriendSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(LikeCommentSeeder::class);
        $this->call(MessageSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
