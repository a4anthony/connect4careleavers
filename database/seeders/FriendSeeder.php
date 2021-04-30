<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $users2Follow = User::whereNotIn('id', [$user->id])->inRandomOrder()->limit(mt_rand(5, 10))->get();
            foreach ($users2Follow as $user2Follow) {
                Friend::factory()->create([
                    'user_id' => $user->id,
                    'friend_id' => $user2Follow->id,
                ]);
            }
        }
    }
}
