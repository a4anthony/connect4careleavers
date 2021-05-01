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
            $users2Follow = User::whereNotIn('id', [$user->id])->inRandomOrder()->limit(mt_rand(10, 20))->get();
            foreach ($users2Follow as $user2Follow) {
                $check = Friend::where([
                    'user_id' => $user2Follow->id,
                    'friend_id' => $user->id,
                ])->exists();
                if (!$check) {
                    Friend::factory()->create([
                        'user_id' => $user->id,
                        'friend_id' => $user2Follow->id,
                    ]);
                }
            }
        }
    }
}
