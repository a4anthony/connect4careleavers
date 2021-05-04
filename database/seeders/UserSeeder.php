<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'john@email.com',
            'username' => 'johndoe',
            'name'=> 'John Doe',
            'is_active' => true,
            'is_admin' => true,
            'avatar' => 'https://via.placeholder.com/400x400.png/0088dd?text=JD'
        ]);
        User::factory()->create([
            'email' => 'admin@email.com',
            'username' => 'admin',
            'name'=> 'Admin User',
            'is_active' => true,
            'is_admin' => true,
            'avatar' => 'https://via.placeholder.com/400x400.png/0088dd?text=AU'
        ]);
        User::factory(48)->create();
    }
}
