<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
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
            $users2Msg = User::whereNotIn('id', [$user->id])->get();
            foreach ($users2Msg as $user2Msg) {
                Message::factory(5)->create([
                    'user_id' => $user->id,
                    'friend_id' => $user2Msg->id,
                ]);
                Message::factory(5)->create([
                    'friend_id' => $user->id,
                    'user_id' => $user2Msg->id,
                ]);
            }
        }
    }
}
