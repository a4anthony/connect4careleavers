<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$gender =
        $name = $this->faker->name();
        $fname = $this->faker->firstName;
        $lname = $this->faker->lastName;
        $abrr = substr($fname, 0, 1) . substr($lname, 0, 1);
        dump($abrr);
        //dd($this->faker->imageUrl(100, 100, null, false, $abrr, false));
        //substr("hello", 0, 1)
        return [
            'name' => $fname . ' ' . $lname,
            'username' => $this->faker->unique()->userName,
            'country' => $this->faker->country,
            'avatar' => $this->faker->imageUrl(400, 400, null, false, $abrr, false),
            'bio' => $this->faker->text(200),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
